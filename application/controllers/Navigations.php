<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigations extends CI_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_navigations'
    ]);

    $this->pk = M_navigations::$pk;
    $this->table = M_navigations::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data navigations',
      'content' => 'navigations/index',
      'action' => site_url('navigations/get_all'),
      'delete_action' => site_url('navigations/delete'),
      'detail_url' => site_url('navigations/detail/'),
      'edit_url' => site_url('navigations/edit/'),
      // 'page' => $this->uri->segment(3, 1)
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Detail navigations',
      'action' => site_url('navigations/get_by_id/'),
      'content' => 'navigations/detail',
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function create_page() {
    $data['title'] = 'Tambah Halaman';
    $data['action'] = site_url('navigations/create_action');
    $data['content'] = 'navigations/create_page';

    $this->load->view('backend/index', $data);
  }

  public function create_navigation() {
    $data['title'] = 'Tambah Navigasi Dropdown';
    $data['action'] = site_url('navigations/create_navigation_action');
    $data['content'] = 'navigations/create_navigation';

    $this->load->view('backend/index', $data);
  }

  public function create_dropdown() {
    $data['title'] = 'Tambah Halaman: Dropdown';
    $data['action'] = site_url('navigations/create_action');
    $data['content'] = 'navigations/create_dropdown';

    $this->load->view('backend/index', $data);
  }

  public function create_navigation_action() {
    // if ($this->input->is_ajax_request()) {
      if ($this->validation()) {
        $data = ['title' => $this->input->post('title', true)];
        $last_id = $this->m_navigations->create($data);

        if ($last_id) {
          $this->vars['message'] = 'Data baru berhasil dibuat';
          $this->vars['status'] = 'success';
          $this->vars['nav_id'] = $last_id;
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
    // }
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
    }
  }

  public function edit() {
    $data = [
      'title' => 'Edit navigations',
      'content' => 'navigations/edit',
      'get_action' => site_url('navigations/get_by_id/'),
      'action' => site_url('navigations/edit_action'),
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
      // $data = $this->m_navigations->get_all($limit, $offset);
      $data = $this->m_navigations->get_all();

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
      'type' => 'navigations'
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

  private function upload_image() {
    $config = [
      'upload_path' => './media_library/navigations/',
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
      $this->resize_image(FCPATH.'media_library/navigations', $file['file_name']);

      return $file;
    }
  }

  private function resize_image($path, $filename) {
    $this->load->library('image_lib');

		// Large Image
		$large['image_library'] = 'gd2';
		$large['source_image'] = $path .'/'. $filename;
		$large['new_image'] = './media_library/navigations/lg_'. $filename;
    $large['maintain_ratio'] = true;
    $large['width'] = 800;
    $large['height'] = 600;
		$this->image_lib->initialize($large);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Medium Image
		$medium['image_library'] = 'gd2';
		$medium['source_image'] = $path .'/'. $filename;
		$medium['new_image'] = './media_library/navigations/md_'. $filename;
    $medium['maintain_ratio'] = true;
    $medium['width'] = 460;
    $medium['height'] = 308;
		$this->image_lib->initialize($medium);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Small Image
		$small['image_library'] = 'gd2';
		$small['source_image'] = $path .'/'. $filename;
		$small['new_image'] = './media_library/navigations/sm_'. $filename;
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