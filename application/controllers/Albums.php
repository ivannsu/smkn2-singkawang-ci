<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends Admin_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_albums',
      'm_photos'
    ]);

    $this->pk = M_albums::$pk;
    $this->table = M_albums::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Album',
      'content' => 'albums/index',
      'action' => site_url('albums/get_all'),
      'delete_action' => site_url('albums/delete'),
      'detail_url' => site_url('photos/index/'),
      'edit_url' => site_url('albums/edit/'),
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Detail Artikel',
      'action' => site_url('albums/get_by_id/'),
      'content' => 'albums/detail',
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $data['title'] = 'Tambah Album';
    $data['action'] = site_url('albums/create_action');
    $data['content'] = 'albums/create'; 

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

  public function edit() {
    $data = [
      'title' => 'Edit Album',
      'content' => 'albums/edit',
      'get_action' => site_url('albums/get_by_id/'),
      'action' => site_url('albums/edit_action'),
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function edit_action() {
    if ($this->input->is_ajax_request()) {
      $id = $this->get_post_id();
      $data = $this->get_post_data();

      $action = $this->model->update($this->table, $data, $id);
      $vars = [];

      if ($action) {
        $vars['message'] = 'Sukses mengedit data';
        $vars['status'] = 'success';
      } else {
        $vars['message'] = 'Terjadi kesalahan saat mengedit data';
        $vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($vars));
    } else {
      $this->show_404();
    }
  }

  public function get_all() {
    if ($this->input->is_ajax_request()) {
      $vars = [];
      $data = $this->m_albums->get_all();

      if ($data) {
        $vars['message'] = 'Sukses menampilkan data';
        $vars['status'] = 'success';
        $vars['data'] = $data;
      } else {
        $vars['message'] = 'Terjadi kesalahan saat menampilkan data';
        $vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($vars));
    } else {
      $this->show_404();
    }
  }

  public function delete() {
    if ($this->input->is_ajax_request()) {
      $id = $this->get_post_id();
      $count = $this->m_photos->count_by_album($id);

      if ($count == 0) {
        $action = $this->model->delete($this->table, $id);
        $action = TRUE;

        if ($action) {
          $this->vars['message'] = 'Sukses menghapus data';
          $this->vars['status'] = 'success';
        } else {
          $this->vars['message'] = 'Terjadi kesalahan saat menghapus data';
          $this->vars['status'] = 'failed';
        }
      } else {
        $this->vars['message'] = 'Masih ada Foto di dalam Album, Hapus Semua Foto di Album terlebih dahulu !';
        $this->vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      $this->show_404();
    }
  }

  public function get_by_id() {
    if ($this->input->is_ajax_request()) {
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
    } else {
      $this->show_404();
    }
  }

  private function get_post_data() {
    return [
      'title' => $this->input->post('title', true)
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }

  private function validation() {
    $this->load->library('form_validation');

		$val = $this->form_validation;
		$val->set_rules('title', 'Title', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }
}

?>