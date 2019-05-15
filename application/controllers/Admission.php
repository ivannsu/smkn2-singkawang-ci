<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends Admin_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_admission'
    ]);

    $this->pk = M_admission::$pk;
    $this->table = M_admission::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Admisi',
      'content' => 'admission/index',
      'get_all_action' => site_url('admission/get_all'),
      'create_action' => site_url('admission/create_action'),
      'set_active_action' => site_url('admission/set_active_action'),
      'delete_action' => site_url('admission/delete'),
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Detail Artikel',
      'action' => site_url('admission/get_by_id/'),
      'content' => 'admission/detail',
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $data['title'] = 'Tambah Artikel';
    $data['action'] = site_url('admission/create_action');
    $data['content'] = 'admission/create'; 

    $this->load->view('backend/index', $data);
  }
  
  public function create_action() {
    if ($this->input->is_ajax_request()) {
      if ($this->validation()) {
        $data = $this->get_post_data();

        if ($this->model->create($this->table, $data)) {
          $this->vars['message'] = 'Data baru berhasil dibuat';
          $this->vars['status'] = 'success';
          
        } else {
          $this->vars['message'] = 'Terjadi kesalahan saat menyimpan data';
          $this->vars['status'] = 'failed';
        }

      } else {
        $this->vars['status'] = 'failed';
				$this->vars['message'] = validation_errors();
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      $this->show_404();
    }
  }

  public function set_active_action() {
    $id = $this->get_post_id();

    $action = $this->m_admission->set_active_phase($id);

    if ($action) {
      $this->vars['message'] = 'Data telah diaktifkan';
      $this->vars['status'] = 'success';
    } else {
      $this->vars['message'] = 'Terjadi kesalahan saat mengaktifkan data';
      $this->vars['status'] = 'failed';
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($this->vars));
  }

  public function edit() {
    $data = [
      'title' => 'Edit Artikel',
      'content' => 'admission/edit',
      'get_action' => site_url('admission/get_by_id/'),
      'action' => site_url('admission/edit_action'),
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function edit_action() {
    $id = $this->get_post_id();
    $data = $this->get_post_data();
    $action = $this->model->update($this->table, $data, $id);

    if ($action) {
      $this->vars['message'] = 'Sukses mengedit data';
      $this->vars['status'] = 'success';
    } else {
      $this->vars['message'] = 'Terjadi kesalahan saat mengedit data';
      $this->vars['status'] = 'failed';
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($this->vars));
  }

  public function get_all() {
    if ($this->input->is_ajax_request()) {
      $data = $this->m_admission->get_all();

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
      $this->show_404();
    }
  }

  public function delete() {
    $id = $this->get_post_id();
    $action = $this->model->delete($this->table, $id);

    if ($action) {
      $this->vars['message'] = 'Sukses menghapus data';
      $this->vars['status'] = 'success';
    } else {
      $this->vars['message'] = 'Terjadi kesalahan saat menghapus data';
      $this->vars['status'] = 'failed';
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($this->vars));
  }

  public function get_by_id() {
    $id = $this->uri->segment(3);
    $row = $this->model->get_row($this->pk, $id, $this->table);

    if ($row) {
      $vars['message'] = 'Sukses menampilkan data';
      $vars['status'] = 'success';
      $vars['row'] = $row;
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($vars));
  }

  private function get_post_data() {
    return [
      'academic_year' => $this->input->post('academic_year', true),
      'phase_start_date' => $this->input->post('phase_start_date', true),
      'phase_end_date' => $this->input->post('phase_end_date', true),
      'active' => 'false',
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }

  private function validation() {
    $this->load->library('form_validation');

		$val = $this->form_validation;
    $val->set_rules('academic_year', 'Tahun Akademik', 'trim|required');
    $val->set_rules('phase_start_date', 'Tanggal Mulai PPDB', 'trim|required');
    $val->set_rules('phase_end_date', 'Tanggal Selesai PPDB', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }
}

?>