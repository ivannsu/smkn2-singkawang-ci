<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppdb extends Public_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public function __construct() {
    parent::__construct();

    $this->load->model([
      'm_profile',
      'm_navigations',
      'm_students',
      'm_users'
    ]);

    $this->pk = M_students::$pk;
    $this->table = M_students::$table;
  }

  public function index() {
    if ($this->session->user_level == 'CANDIDATE_STUDENTS') {
      $user_id = $this->session->user_id;
      $last_step = $this->m_students->current_candidate_step($user_id);

      redirect('public/ppdb/step/'.$last_step);
    } else {
      redirect('public/ppdb/registrasi');
    }
  }

  public function step() {
    if ($this->session->user_level != 'CANDIDATE_STUDENTS') {
      redirect('public/ppdb/login');
    }

    $this->load->model('m_jurusan');
    
    $step = $this->uri->segment(4);
    $user_id = $this->session->user_id;
    $last_step = $this->m_students->current_candidate_step($user_id);

    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();
    $data['last_step'] = $this->m_students->current_candidate_step($user_id);

    if ($step == '1') {
      $this->step1($user_id, $data);
    } else if ($step == '2') {
      if ($last_step < $step) {
        show_404();
      } else {
        $this->step2($user_id, $data);
      }
    } else if ($step == '3') {
      if ($last_step < $step) {
        show_404();
      } else {
        $this->step3($user_id, $data);
      }
    } else if ($step == '4') {
      if ($last_step < $step) {
        show_404();
      } else {
        $this->step4($user_id, $data);
      }
    } else {
      show_404();
    }
    
  }

  private function step1($user_id, $data) {
    $data['jurusan'] = $this->m_jurusan->get_all();
    $data['student_name'] = $this->model->get_row('id', $user_id, 'users')->name;
    $data['action'] = site_url('public/ppdb/step1_process');
    $data['get_action'] = site_url('public/ppdb/get_candidate_data/');

    $this->load->view('public/ppdb/step1', $data);
  }

  private function step2($user_id, $data) {
    $data['student_name'] = $this->model->get_row('id', $user_id, 'users')->name;
    $data['action'] = site_url('public/ppdb/step2_process');
    $data['get_action'] = site_url('public/ppdb/get_candidate_data/');

    $this->load->view('public/ppdb/step2', $data);
  }

  private function step3($user_id, $data) {
    $data['student_name'] = $this->model->get_row('id', $user_id, 'users')->name;
    $data['action'] = site_url('public/ppdb/step3_process');
    $data['get_action'] = site_url('public/ppdb/get_candidate_data/');

    $this->load->view('public/ppdb/step3', $data);
  }

  private function step4($user_id, $data) {
    $data['get_action'] = site_url('public/ppdb/get_candidate_data/');

    $this->load->view('public/ppdb/step4', $data);
  }

  public function test() {
    $user_id = $this->session->user_id;

    $data['session_user_id'] = $user_id;

    $data['data'] = $this->m_students->get_by_user($user_id);

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
  }

  public function kartu_registrasi_sementara() {
    $user_id = $this->session->user_id;
    $user_level = $this->session->user_level;

    if ( ! empty($user_id) AND ($user_level == 'CANDIDATE_STUDENTS')) {
      include_once APPPATH.'/third_party/fpdf/fpdf.php';

      $this->load->helper('format');

      $candidate = $this->m_students->get_by_user($user_id);
      $profile = $this->m_profile->get();

      $pdf = new FPDF('p', 'mm', 'A4');
      $pdf->AddPage();
      $pdf->SetTitle('Kartu Registrasi Sementara - '.$profile->name);

      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(0, 10, $profile->name, 0, 1, 'C');
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(0, 10, 'PPDB Online', 0, 1, 'C');
      $pdf->SetFont('Arial', '', 12);
      $pdf->Cell(0, 10, 'Kartu Registrasi Sementara', 0, 1, 'C');
      $pdf->Cell(0, 10, '', 'T', 1, 'C');

      $pdf->Cell(60, 10, 'No. Registrasi :');
      $pdf->Cell(0, 10, readbleUniqID($candidate->registration_id), 0, 1);
      $pdf->Cell(60, 10, 'Nama :');
      $pdf->Cell(0, 10, strtoupper($candidate->name), 0, 1);
      $pdf->Cell(60, 10, 'Asal SMP :');
      $pdf->Cell(0, 10, strtoupper($candidate->prev_school_name), 0, 1);
      $pdf->Cell(60, 10, 'Jurusan yang diminati :');
      $pdf->Cell(0, 10, strtoupper($candidate->jurusan), 0, 1);
     
      $pdf_stream = $pdf->Output('', 'S');

      $this->output
        ->set_content_type('application/pdf')
        ->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT')
        ->set_header('Cache-Control: no-store, no-cache, must-revalidate')
        ->set_output($pdf_stream);

      // $pdf->Output();
    }
  }

  public function get_candidate_data() {
    $user_id = $this->session->user_id;
    $user_level = $this->session->user_level;

    if ( ! empty($user_id) AND ($user_level == 'CANDIDATE_STUDENTS')) {
      $data = $this->model->get_row('user_id', $user_id, 'students');

      $this->vars['status'] = 'success';
      $this->vars['row'] = $data;

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  public function step1_process() {
    $user_id = $this->session->user_id;
    $user_level = $this->session->user_level;

    if ( ! empty($user_id) AND ($user_level == 'CANDIDATE_STUDENTS')) {
      $data = $this->get_step1_data();
      $update = $this->m_students->update('students', $data, $user_id);

      if ($update) {
        // Update Last Candidate Step
        $this->m_students->update('students', ['current_candidate_step' => 2], $user_id);

        $this->vars['message'] = 'Data berhasil disimpan';
        $this->vars['status'] = 'success';
        $this->vars['redirect_link'] = site_url('public/ppdb/step/2');
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat melakukan menyimpan akun';
        $this->vars['status'] = 'failed';
      }    

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  public function step2_process() {
    $user_id = $this->session->user_id;
    $user_level = $this->session->user_level;

    if ( ! empty($user_id) AND ($user_level == 'CANDIDATE_STUDENTS')) {
      $data = $this->get_step2_data();
      $update = $this->m_students->update('students', $data, $user_id);

      if ($update) {
        // Update Last Candidate Step
        $this->m_students->update('students', ['current_candidate_step' => 3], $user_id);

        // $this->vars['data'] = $data;
        $this->vars['message'] = 'Data berhasil disimpan';
        $this->vars['status'] = 'success';
        // $this->vars['redirect_link'] = site_url('public/ppdb/step/2');
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat melakukan menyimpan akun';
        $this->vars['status'] = 'failed';
      }    

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  public function registrasi() {
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();
    $data['action'] = site_url('public/ppdb/registrasi_action');

    $this->load->view('public/ppdb/registrasi', $data);
  }

  public function login() {
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();
    $data['action'] = site_url('login/login_action');

    $this->load->view('public/ppdb/login', $data);
  }

  public function registrasi_action() {
    if ($this->input->is_ajax_request()) {
      if ($this->registrasi_validation()) {
        $data = $this->get_registrasi_data();
        $email = $data['email'];
        $username = $data['username'];

        $username_availablity = $this->m_users->getByUsername($username)->num_rows();
        $email_availablity = $this->m_users->getByEmail($email)->num_rows();

        if ($username_availablity > 0) {
          $this->vars['message'] = 'Username sudah dipergunakan';
          $this->vars['status'] = 'failed';
        } else if ($email_availablity > 0) {
          $this->vars['message'] = 'Email sudah dipergunakan';
          $this->vars['status'] = 'failed';
        } else {
          $create = $this->m_users->create_candidate_student_account($data);

          if ($create) {
            $this->vars['message'] = 'Registrasi Akun PPDB berhasil, Alihkan halaman dalam 2 detik';
            $this->vars['status'] = 'success';
            
          } else {
            $this->vars['message'] = 'Terjadi kesalahan saat melakukan registrasi akun';
            $this->vars['status'] = 'failed';
          }
        }

      } else {
        $this->vars['status'] = 'failed';
				$this->vars['message'] = validation_errors();
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  private function get_registrasi_data() {
    return [
      'name' => $this->input->post('name', true),
      'username' => $this->input->post('username', true),
      'email' => $this->input->post('email', true),
      'username' => $this->input->post('username', true),
      'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
      'level' => 'CANDIDATE_STUDENTS'
    ];
  }

  private function get_step1_data() {
    return [
      'prev_school_name' => $this->input->post('prev_school_name', true),
      'prev_school_address' => $this->input->post('prev_school_address', true),
      'jurusan_id' => $this->input->post('jurusan_id', true),
    ];
  }

  private function get_step2_data() {
    return [
      'gender' => $this->input->post('gender', true),
      'birth_place' => $this->input->post('birth_place', true),
      'birth_date' => $this->input->post('birth_date', true),
      'religion' => $this->input->post('religion', true),
      'street_address' => $this->input->post('street_address', true),
      'rt' => $this->input->post('rt', true),
      'rw' => $this->input->post('rw', true),
      'village' => $this->input->post('village', true),
      'sub_district' => $this->input->post('sub_district', true),
      'district' => $this->input->post('district', true),
      'postal_code' => $this->input->post('postal_code', true),
      'phone' => $this->input->post('phone', true),
      'hobby' => $this->input->post('hobby', true),
      'ambition' => $this->input->post('ambition', true),
      'height' => $this->input->post('height', true),
      'weight' => $this->input->post('weight', true),
      'mileage' => $this->input->post('mileage', true),
      'travelling_time' => $this->input->post('travelling_time', true),
      'siblings_number' => $this->input->post('siblings_number', true),
      'father_name' => $this->input->post('father_name', true),
      'father_education' => $this->input->post('father_education', true),
      'father_job' => $this->input->post('father_job', true),
      'father_monthly_income' => $this->input->post('father_monthly_income', true),
      'father_phone' => $this->input->post('father_phone', true),
      'father_email' => $this->input->post('father_email', true),
      'father_condition' => $this->input->post('father_condition', true),
      'mother_name' => $this->input->post('mother_name', true),
      'mother_education' => $this->input->post('mother_education', true),
      'mother_job' => $this->input->post('mother_job', true),
      'mother_monthly_income' => $this->input->post('mother_monthly_income', true),
      'mother_phone' => $this->input->post('mother_phone', true),
      'mother_email' => $this->input->post('mother_email', true),
      'mother_condition' => $this->input->post('mother_condition', true),
      'guardian_name' => $this->input->post('guardian_name', true),
      'guardian_education' => $this->input->post('guardian_education', true),
      'guardian_job' => $this->input->post('guardian_job', true),
      'guardian_monthly_income' => $this->input->post('guardian_monthly_income', true),
      'guardian_phone' => $this->input->post('guardian_phone', true),
      'guardian_email' => $this->input->post('guardian_email', true),
    ];
  }

  private function step1_validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('prev_school_name', 'Asal SMP', 'trim|required');
    $val->set_rules('prev_school_address', 'Alamat SMP', 'trim|required');
    $val->set_rules('jurusan_id', 'Jurusan', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }

  private function registrasi_validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('name', 'Name', 'trim|required');
    $val->set_rules('username', 'Username', 'trim|required');
    $val->set_rules('email', 'Email', 'trim|required|valid_email');
    $val->set_rules('username', 'Username', 'trim|required');
    $val->set_rules('password', 'Password', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }
}

?>