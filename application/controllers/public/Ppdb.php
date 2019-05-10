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
      redirect('public/ppdb/step/1');
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

    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();

    if ($step == '1') {
      $this->step1($user_id, $data);
    } else if ($step == '2') {
      $this->step2($user_id, $data);
    } else {
      echo 'ga ada step';
    }
    
  }

  private function step1($user_id, $data) {
    $data['jurusan'] = $this->m_jurusan->get_all();
    $data['student_name'] = $this->model->get_row('id', $user_id, 'users')->name;
    $data['id'] = $user_id;
    $data['action'] = site_url('public/ppdb/step1_process');
    $data['get_action'] = site_url('public/ppdb/step1_get_data/');

    $this->load->view('frontend/ppdb/step1', $data);
  }

  private function step2($user_id, $data) {
    $data['jurusan'] = $this->m_jurusan->get_all();
    $data['student_name'] = $this->model->get_row('id', $user_id, 'users')->name;
    $data['id'] = $user_id;
    $data['action'] = site_url('public/ppdb/step1_process');
    $data['get_action'] = site_url('public/ppdb/step1_get_data/');

    $this->load->view('frontend/ppdb/step2', $data);
  }

  public function step1_get_data() {
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

  public function registrasi() {
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();
    $data['action'] = site_url('public/ppdb/registrasi_action');

    $this->load->view('frontend/ppdb/registrasi', $data);
  }

  public function login() {
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();
    $data['action'] = site_url('login/login_action');

    $this->load->view('frontend/ppdb/login', $data);
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