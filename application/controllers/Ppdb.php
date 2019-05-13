<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppdb extends Admin_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_students'
    ]);

    $this->pk = M_students::$pk;
    $this->table = M_students::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Pendaftar',
      'content' => 'ppdb/index',
      'action' => site_url('ppdb/get_all_candidates'),
      'check_url' => site_url('ppdb/check/')
    ];

    $this->load->view('backend/index', $data);
  }

  public function selection() {
    $data = [
      'title' => 'Seleksi PPDB',
      'content' => 'ppdb/selection',
      'action' => site_url('ppdb/selection_get_all_candidates'),
    ];

    $this->load->view('backend/index', $data);
  }

  public function check() {
    $user_id = $this->uri->segment(3);

    $data = [
      'title' => 'Cek Data Pendaftar',
      'content' => 'ppdb/check',
      'user_id' => $user_id,
      'action' => site_url('ppdb/get_candidate/'.$user_id),
      'upload_action' => site_url('ppdb/upload_berkas'),
      'save_exam_scores_action' => site_url('ppdb/save_exam_scores'),
      'confirm_candidate_action' => site_url('ppdb/confirm_candidate')
    ];

    $this->load->view('backend/index', $data);
  }

  public function confirm_candidate() {
    $user_id = $this->input->post('user_id', true);
    $update = $this->m_students->update($this->table, ['current_candidate_step' => 4], $user_id);

    if ($update) {
      $this->vars['message'] = 'Data terverifikasi';
      $this->vars['status'] = 'success';
    } else {
      $this->vars['message'] = 'Terjadi kesalahan saat menyimpan data';
      $this->vars['status'] = 'failed';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
  }

  public function upload_berkas() {
    $user_id = $this->input->post('user_id', true);
    
    $this->tmp['upload_failed'] = FALSE;

    if ( ! empty($_FILES['berkas'])) {
      $upload = $this->upload_image();
      if ($upload) {
        $data[$this->input->post('berkas_name')] = $upload['file_name'];
      }
    }

    if ( ! $this->tmp['upload_failed']) {
      if ($this->m_students->update($this->table, $data, $user_id)) {
        $this->vars['message'] = 'Berkas berhasil diupload';
        $this->vars['status'] = 'success';
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat menyimpan data';
        $this->vars['status'] = 'failed';
      }
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
  }

  public function save_exam_scores() {
    $this->load->helper('format');

    $user_id = $this->input->post('user_id', true);
    $exam_scores = [
      'mtk' => $this->input->post('exam_mtk_score', true),
      'bi' => $this->input->post('exam_bi_score', true),
      'bing' => $this->input->post('exam_bingg_score', true),
      'ipa' => $this->input->post('exam_ipa_score', true),
    ];

    $data['national_exam_scores'] = convertExamScores($exam_scores);

    $update = $this->m_students->update($this->table, $data, $user_id);

    if ($update) {
      $this->vars['message'] = 'Data berhasil disimpan';
      $this->vars['status'] = 'success';
    } else {
      $this->vars['message'] = 'Terjadi kesalahan saat menyimpan data';
      $this->vars['status'] = 'failed';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
  }

  public function selection_get_all_candidates() {
    if ($this->input->is_ajax_request()) {
      $data = $this->m_students->get_all_candidates('selection');

      if ($data) {
        $this->vars['message'] = 'Sukses menampilkan data';
        $this->vars['status'] = 'success';
        $this->vars['data'] = $data;
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat menampilkan data';
        $this->vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      show_404();
    }
  }

  public function get_all_candidates() {
    if ($this->input->is_ajax_request()) {
      $data = $this->m_students->get_all_candidates();

      if ($data) {
        $this->vars['message'] = 'Sukses menampilkan data';
        $this->vars['status'] = 'success';
        $this->vars['data'] = $data;
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat menampilkan data';
        $this->vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      show_404();
    }
  }

  public function get_candidate() {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->uri->segment(3);
      $row = $this->m_students->get_by_user($user_id);

      if ($row) {
        if ($row->national_exam_scores) { 
          $this->load->helper('format');
          $row->national_exam_scores = readbleExamScores($row->national_exam_scores);
        }

        $this->vars['message'] = 'Sukses menampilkan data';
        $this->vars['status'] = 'success';
        $this->vars['row'] = $row;
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat menampilkan data';
        $this->vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      show_404();
    }
  }

  private function upload_image() {
    $config = [
      'upload_path' => './media_library/students_berkas/',
      'allowed_types' => 'jpg|png|jpeg|gif',
      'max_size' => 0,
      'encrypt_name' => true
    ];
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('berkas')) {
      $this->vars['status'] = 'failed';
      $this->vars['message'] = $this->upload->display_errors();
      $this->tmp['upload_failed'] = TRUE;

      return FALSE;
    } else {
      $file = $this->upload->data();

      return $file;
    }
  }
}

?>