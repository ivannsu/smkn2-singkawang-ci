<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends Admin_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];
  private $tmp = [];
  private $image_path = FCPATH.'media_library/alumni/';

  public  function __construct() {
    parent::__construct();

    $this->load->model([
      'm_alumni'
    ]);

    $this->pk = M_alumni::$pk;
    $this->table = M_alumni::$table;
  }

  public function index() {
    $data = [
      'title' => 'Data Alumni',
      'content' => 'alumni/index',
      'action' => site_url('alumni/get_all'),
      'delete_action' => site_url('alumni/delete'),
      'import_action' => site_url('alumni/import_excel'),
      'detail_url' => site_url('alumni/detail/'),
      'edit_url' => site_url('alumni/edit/'),
      // 'page' => $this->uri->segment(3, 1)
    ];

    $this->load->view('backend/index', $data);
  }

  public function detail() {
    $data = [
      'title' => 'Detail Alumni',
      'action' => site_url('alumni/get_by_id/'),
      'content' => 'alumni/detail',
      'id' => $this->uri->segment(3)
    ];

    $this->load->view('backend/index', $data);
  }

  public function create() {
    $this->load->model('m_jurusan');

    $data['title'] = 'Tambah Alumni';
    $data['jurusan'] = $this->m_jurusan->get_all();
    $data['action'] = site_url('alumni/create_action');
    $data['content'] = 'alumni/create'; 

    $this->load->view('backend/index', $data);
  }
  
  public function create_action() {
    if ($this->input->is_ajax_request()) {
      if ($this->validation()) {
        $data = $this->get_post_data();
        $data['is_verified'] = 'true';

        $this->tmp['upload_failed'] = FALSE;

        if ( ! empty($_FILES['image'])) {
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
    $this->load->model('m_jurusan');
    $data = [
      'title' => 'Edit Alumni',
      'content' => 'alumni/edit',
      'get_action' => site_url('alumni/get_by_id/'),
      'action' => site_url('alumni/edit_action'),
      'id' => $this->uri->segment(3),
      'jurusan' => $this->m_jurusan->get_all()
    ];

    $this->load->view('backend/index', $data);
  }

  public function edit_action() {
    $vars = [];
    $id = $this->get_post_id();
    $data = $this->get_post_data();
    $data['is_verified'] = $this->input->post('is_verified', true);

    $action = $this->model->update($this->table, $data, $id);
  
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
      $data = $this->m_alumni->get_all();

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
    $vars = [];
    $id = $this->get_post_id();
    // $tmp_image = $this->model->get_row($this->pk, $id, $this->table)->image;

    $action = $this->model->delete($this->table, $id);

    if ($action) {
      // @unlink($this->image_path.'lg_'.$tmp_image);
      // @unlink($this->image_path.'md_'.$tmp_image);
      // @unlink($this->image_path.'sm_'.$tmp_image);

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
    $row = $this->m_alumni->get_by_id($id);

    if ($row) {
      $this->vars['message'] = 'Sukses menampilkan data';
      $this->vars['status'] = 'success';
      $this->vars['row'] = $row;
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($this->vars));
  }

  public function import_excel() {
    if ($this->input->is_ajax_request()) {
      if ( ! empty($_FILES['media_excel'])) {
        $upload = $this->upload_excel();
        if ($upload) {
          include APPPATH.'third_party/PHPExcel/PHPExcel.php';

          $excel_reader = new PHPExcel_Reader_Excel2007();
          $load_excel = $excel_reader->load(FCPATH.'media_library/excel/'.$upload['file_name']);
          $sheet = $load_excel->getActiveSheet()->toArray(null, true, true ,true);
          $excel_data = [];

          $numrow = 1;
          foreach($sheet as $row){
            if($numrow > 1){
              array_push($excel_data, array(
                'name' => $row['A'],
                'gender' => $row['B'],
                'address' => $row['C'],
                'telp' => $row['D'],
                'email' => $row['E'],
                'angkatan' => $row['F'],
                'jurusan_id' => $row['G'],
                'job' => $row['H'],
                'college' => $row['I'],
              ));
            }
            $numrow++;
          }

          $insert = $this->insert_multiple($excel_data);

          $this->vars['info'] = $insert;

          if ($insert) {
            $this->vars['message'] = 'Sukses mengimport data';
            $this->vars['status'] = 'success';
          } else {
            $this->vars['status'] = 'failed';
            $this->vars['message'] = 'Terjadi kesalahan saat mengimport data';
          }

        }
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      $this->show_404();
    }
  }

  private function upload_excel() {
    $this->load->library('upload');
    
    $config['upload_path'] = './media_library/excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = 'excel_data';
  
    $this->upload->initialize($config);
    if($this->upload->do_upload('media_excel')){
      $file = $this->upload->data();

      return $file;
    }else{
      $this->vars['message'] = $this->upload->display_errors();
      $this->vars['status'] = 'failed';

      return FALSE;
    }
  }

  private function insert_multiple($data){
    return $this->db->insert_batch('alumni', $data);
  }

  private function get_post_data() {
    return [
      'name' => $this->input->post('name', true),
      'gender' => $this->input->post('gender', true),
      'address' => $this->input->post('address', true),
      'telp' => $this->input->post('telp', true),
      'email' => $this->input->post('email', true),
      'angkatan' => $this->input->post('angkatan', true),
      'jurusan_id' => $this->input->post('jurusan_id', true),
      'job' => $this->input->post('job', true),
      'college' => $this->input->post('college', true),
    ];
  }

  private function get_post_id() {
    return $this->input->post('id', true);
  }

  private function validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('name', 'Name', 'trim|required');
    $val->set_rules('gender', 'Gender', 'trim|required');
    $val->set_rules('address', 'Address', 'trim|required');
    $val->set_rules('telp', 'Telp', 'trim|required');
    $val->set_rules('angkatan', 'Angkatan', 'trim|required');
    $val->set_rules('jurusan_id', 'Jurusan', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
		return $val->run();
  }

  private function upload_image() {
    $config = [
      'upload_path' => './media_library/alumni/',
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
      $this->resize_image(FCPATH.'media_library/alumni', $file['file_name']);

      return $file;
    }
  }

  private function resize_image($path, $filename) {
    $this->load->library('image_lib');

		// Large Image
		$large['image_library'] = 'gd2';
		$large['source_image'] = $path .'/'. $filename;
		$large['new_image'] = './media_library/alumni/lg_'. $filename;
    $large['maintain_ratio'] = true;
    $large['width'] = 800;
    $large['height'] = 600;
		$this->image_lib->initialize($large);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Medium Image
		$medium['image_library'] = 'gd2';
		$medium['source_image'] = $path .'/'. $filename;
		$medium['new_image'] = './media_library/alumni/md_'. $filename;
    $medium['maintain_ratio'] = true;
    $medium['width'] = 460;
    $medium['height'] = 308;
		$this->image_lib->initialize($medium);
		$this->image_lib->resize();
    $this->image_lib->clear();
    
    // Small Image
		$small['image_library'] = 'gd2';
		$small['source_image'] = $path .'/'. $filename;
		$small['new_image'] = './media_library/alumni/sm_'. $filename;
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