<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {
  private $pk = '';
  private $table = '';

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_posts'
    ]);

    $this->pk = M_posts::$pk;
    $this->table = M_posts::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Artikel',
      'content' => 'posts/index',
      'action' => site_url('posts/get_all'),
      'delete_action' => site_url('posts/delete'),
      'detail_url' => site_url('posts/detail/'),
      'edit_url' => site_url('posts/edit/'),
      // 'page' => $this->uri->segment(3, 1)
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Detail Artikel',
      'action' => site_url('posts/get_by_id/'),
      'content' => 'posts/detail',
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $data['title'] = 'Tambah Artikel';
    $data['action'] = site_url('posts/create_action');
    $data['content'] = 'posts/create'; 

    $this->load->view('backend/index', $data);
  }
  
  public function create_action() {
    if ($this->input->is_ajax_request()) {
      $vars = [];
      $data = $this->get_post_data();

      if ($this->model->create($this->table, $data)) {
        $vars['message'] = 'Data baru berhasil dibuat';
        $vars['status'] = 'success';
        
      } else {
        $vars['message'] = 'Terjadi kesalahan saat menyimpan data';
        $vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($vars));
    }
  }

  public function edit() {
    $data = [
      'title' => 'Edit Artikel',
      'content' => 'posts/edit',
      'get_action' => site_url('posts/get_by_id/'),
      'action' => site_url('posts/edit_action'),
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function edit_action() {
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
  }

  public function get_all() {
    if ($this->input->is_ajax_request()) {
      $vars = [];
      // $count = $this->model->count_all($this->table);
      // $limit = 5;
      // $offset = ($this->input->get('page') * $limit) - $limit;
      // $data = $this->m_posts->get_all($limit, $offset);
      $data = $this->m_posts->get_all();

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
    }
  }

  public function delete() {
    $id = $this->get_post_id();
    $action = $this->model->delete($this->table, $id);
    $vars = [];

    if ($action) {
      $vars['message'] = 'Sukses menghapus data';
      $vars['status'] = 'success';
    } else {
      $vars['message'] = 'Terjadi kesalahan saat menghapus data';
      $vars['status'] = 'failed';
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($vars));
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
      'title' => $this->input->post('title', true),
      'content' => $this->input->post('content'),
      'author' => 1,
      'type' => 'article'
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }
}

?>