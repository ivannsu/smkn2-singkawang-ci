<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends Admin_Controller {
  private $pk = '';
  private $pk_album = '';
  private $table = '';
  private $table_album = '';
  private $vars = [];
  private $tmp = [];
  private $image_path = FCPATH.'media_library/gallery/';

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_photos'
    ]);

    $this->pk = M_photos::$pk;
    $this->pk_album = 'id';
    $this->table = M_photos::$table;
    $this->table_album = 'albums';
  }

  public function index() {
    $album_id = $this->uri->segment(3);
    $data = [
      'title' => $this->model->get_row($this->pk_album, $album_id, $this->table_album)->title,
      'content' => 'photos/index',
      'action' => site_url('photos/get_by_album'),
      'delete_action' => site_url('photos/delete'),
      'album_id' => $album_id,
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Detail Artikel',
      'action' => site_url('photos/get_by_id/'),
      'content' => 'photos/detail',
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $data['title'] = 'Tambah Foto';
    $data['get_action'] = site_url('albums/get_all');
    $data['action'] = site_url('photos/create_action');
    $data['content'] = 'photos/create'; 

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
    }
  }

  public function edit() {
    $data = [
      'title' => 'Edit Album',
      'content' => 'photos/edit',
      'get_action' => site_url('photos/get_by_id/'),
      'action' => site_url('photos/edit_action'),
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

  public function get_by_album() {
    if ($this->input->is_ajax_request()) {
      $vars = [];
      $id = $this->input->get('album_id');
      $data = $this->m_photos->get_by_album($id);

      if ($data) {
        $vars['message'] = 'Sukses menampilkan data';
        $vars['status'] = 'success';
        $vars['data'] = $data;
      } else if (count($data) == 0) {
        $vars['message'] = 'Tidak ada data';
        $vars['status'] = 'empty';
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
    $vars = [];
    $id = $this->get_post_id();
    $tmp_photo = $this->model->get_row($this->pk, $id, $this->table)->image;
    $action = $this->model->delete($this->table, $id);

    if ($action) {
      @unlink($this->image_path.'lg_'.$tmp_photo);
      @unlink($this->image_path.'sm_'.$tmp_photo);

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

  public function get_by_id($id = NULL) {
    $id = $this->uri->segment(3);
    $row = $this->model->get_row($this->pk, $id, $this->table);

    if ($row) {
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
  }

  private function get_post_data() {
    return [
      'album_id' => $this->input->post('album_id', true)
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }

  private function validation() {
    $this->load->library('form_validation');

		$val = $this->form_validation;
    $val->set_rules('album_id', 'Album', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }

  private function upload_image() {
    $config = [
      'upload_path' => './media_library/gallery/',
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
      $this->resize_image(FCPATH.'media_library/gallery', $file['file_name']);

      return $file;
    }
  }

  private function resize_image($path, $filename) {
    $this->load->library('image_lib');

		// Large Image
		$large['image_library'] = 'gd2';
		$large['source_image'] = $path .'/'. $filename;
		$large['new_image'] = './media_library/gallery/lg_'. $filename;
    $large['maintain_ratio'] = true;
    $large['width'] = 800;
    $large['height'] = 600;
		$this->image_lib->initialize($large);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Small Image
		$small['image_library'] = 'gd2';
		$small['source_image'] = $path .'/'. $filename;
		$small['new_image'] = './media_library/gallery/sm_'. $filename;
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