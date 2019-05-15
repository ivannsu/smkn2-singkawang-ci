<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller {
  private $pk = '';
  private $pk_val = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_profile'
    ]);

    $this->pk = M_profile::$pk;
    $this->pk_val = M_profile::$pk_val;
    $this->table = M_profile::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Profil',
      'content' => 'profile/index',
      'action' => site_url('profile/get_all'),
      'delete_action' => site_url('profile/delete'),
      'detail_url' => site_url('profile/detail/'),
      'edit_url' => site_url('profile/edit/'),
      // 'page' => $this->uri->segment(3, 1)
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Profil Sekolah',
      'action' => site_url('profile/get_by_id/'),
      'content' => 'profile/detail',
      'id' => $this->pk_val
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $data['title'] = 'Tambah Profil';
    $data['action'] = site_url('profile/create_action');
    $data['content'] = 'profile/create'; 

    $this->load->view('backend/index', $data);
  }
  
  public function create_action() {
    if ($this->input->is_ajax_request()) {
      if ($this->validation()) {
        $data = $this->get_post_data();

        $this->tmp['upload_failed'] = FALSE;
        if (! empty($_FILES['image'])) {
          $upload = $this->upload_image();
          if ($upload) {
            $data['image'] = $upload['file_name'];
          }
        }

        if ( ! $this->tmp['upload_failed']) {
          if ($this->model->create($this->table, $data)) {
            $this->vars['message'] = 'Data baru berhasil dibuat';
            $this->vars['status'] = 'success';
            
          } else {
            $this->vars['message'] = 'Terjadi kesalahan saat menyimpan data';
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
    } else {
      $this->show_404();
    }
  }

  public function edit() {
    $data = [
      'title' => 'Edit Profil',
      'content' => 'profile/edit',
      'get_action' => site_url('profile/get_by_id/'),
      'action' => site_url('profile/edit_action'),
      'id' => $this->pk_val
    ];

    $this->load->view('backend/index', $data);
  }

  public function edit_action() {
    $id = $this->get_post_id();
    $data = $this->get_post_data();
    $tmp_data = $this->model->get_row($this->pk, $id, $this->table);

    $this->tmp['upload_failed'] = FALSE;

    if ( ! empty($_FILES['img_header'])) {
      $upload = $this->upload_image('img_header');
      if ($upload) {
        $data['img_header'] = $upload['file_name'];
      }
    }

    if ( ! $this->tmp['upload_failed']) {
      $action = $this->model->update($this->table, $data, $id);

      if ($action) {
        @unlink($upload['file_path'].$tmp_data->img_header);

        $this->vars['message'] = 'Sukses mengedit data';
        $this->vars['status'] = 'success';
      } else {
        $this->vars['message'] = 'Terjadi kesalahan saat mengedit data';
        $this->vars['status'] = 'failed';
      }
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($this->vars));
  }

  public function get_all() {
    if ($this->input->is_ajax_request()) {
      $vars = [];
      // $count = $this->model->count_all($this->table);
      // $limit = 5;
      // $offset = ($this->input->get('page') * $limit) - $limit;
      // $data = $this->m_profile->get_all($limit, $offset);
      $data = $this->m_profile->get_all();

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
      'address' => $this->input->post('address', true),
      'phone' => $this->input->post('phone', true),
      'email' => $this->input->post('email', true),
      'pos' => $this->input->post('pos', true),
      'video' => $this->input->post('video', true),
      'facebook' => $this->input->post('facebook', true),
      'twitter' => $this->input->post('twitter', true),
      'youtube' => $this->input->post('youtube', true),
      'instagram' => $this->input->post('instagram', true)
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }

  private function validation() {
    $this->load->library('form_validation');

		$val = $this->form_validation;
		$val->set_rules('title', 'Title', 'trim|required');
		$val->set_rules('content', 'Content', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }

  private function upload_image($input_name) {
    $config = [
      'upload_path' => './media_library/profile/',
      'allowed_types' => 'jpg|png|jpeg|gif',
      'max_size' => 0,
      'encrypt_name' => true
    ];
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload($input_name)) {
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