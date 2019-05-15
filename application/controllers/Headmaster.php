<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Headmaster extends Admin_Controller {
  private $pk = '';
  private $pk_val = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_headmaster'
    ]);

    $this->pk = M_headmaster::$pk;
    $this->pk_val = M_headmaster::$pk_val;
    $this->table = M_headmaster::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Kepala Sekolah',
      'content' => 'headmaster/index',
      'action' => site_url('headmaster/get_all'),
      'delete_action' => site_url('headmaster/delete'),
      'detail_url' => site_url('headmaster/detail/'),
      'edit_url' => site_url('headmaster/edit/'),
      // 'page' => $this->uri->segment(3, 1)
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Profil Kepala Sekolah',
      'action' => site_url('headmaster/get_by_id/'),
      'content' => 'headmaster/detail',
      'id' => $this->pk_val
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $data['title'] = 'Tambah Profil';
    $data['action'] = site_url('headmaster/create_action');
    $data['content'] = 'headmaster/create'; 

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
      'title' => 'Edit Profil Kepala Sekolah',
      'content' => 'headmaster/edit',
      'get_action' => site_url('headmaster/get_by_id/'),
      'action' => site_url('headmaster/edit_action'),
      'id' => $this->pk_val
    ];

    $this->load->view('backend/index', $data);
  }

  public function edit_action() {
    $id = $this->get_post_id();
    $data = $this->get_post_data();
    $tmp_data = $this->model->get_row($this->pk, $id, $this->table);

    $this->tmp['upload_failed'] = FALSE;

    if ( ! empty($_FILES['image'])) {
      echo 'masuk sini';
      
      $upload = $this->upload_image();
      if ($upload) {
        $data['image'] = $upload['file_name'];
      }
    }

    if ( ! $this->tmp['upload_failed']) {
      $action = $this->model->update($this->table, $data, $id);

      if ($action) {
        @unlink($upload['file_path'].'lg_'.$tmp_data->image);
        @unlink($upload['file_path'].'md_'.$tmp_data->image);
        @unlink($upload['file_path'].'sm_'.$tmp_data->image);

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
      // $data = $this->m_headmaster->get_all($limit, $offset);
      $data = $this->m_headmaster->get_all();

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
      'name' => $this->input->post('name', true),
      'content' => $this->input->post('content', true),
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }

  private function validation() {
    $this->load->library('form_validation');

		$val = $this->form_validation;
		$val->set_rules('name', 'Name', 'trim|required');
		$val->set_rules('content', 'Content', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }

  private function upload_image() {
    $config = [
      'upload_path' => './media_library/profile/',
      'allowed_types' => 'jpg|png|jpeg|gif',
      'max_size' => 0,
      'encrypt_name' => true
    ];
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('image')) {
      $this->vars['status'] = 'failed';
      $this->vars['message'] = $this->upload->display_errors();
      $this->tmp['upload_failed'] = TRUE;

      return FALSE;
    } else {
      $file = $this->upload->data();
      $this->resize_image(FCPATH.'media_library/profile', $file['file_name']);

      return $file;
    }
  }

  private function resize_image($path, $filename) {
    $this->load->library('image_lib');

		// Large Image
		$large['image_library'] = 'gd2';
		$large['source_image'] = $path .'/'. $filename;
		$large['new_image'] = './media_library/profile/lg_'. $filename;
    $large['maintain_ratio'] = true;
    $large['width'] = 800;
    $large['height'] = 600;
		$this->image_lib->initialize($large);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Medium Image
		$medium['image_library'] = 'gd2';
		$medium['source_image'] = $path .'/'. $filename;
		$medium['new_image'] = './media_library/profile/md_'. $filename;
    $medium['maintain_ratio'] = true;
    $medium['width'] = 460;
    $medium['height'] = 308;
		$this->image_lib->initialize($medium);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Small Image
		$small['image_library'] = 'gd2';
		$small['source_image'] = $path .'/'. $filename;
		$small['new_image'] = './media_library/profile/sm_'. $filename;
    $small['maintain_ratio'] = true;
    $small['width'] = 200;
    $small['height'] = 150;
		$this->image_lib->initialize($small);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Unlink Old Image
    @unlink($path.'/'.$filename);
  }
}

?>