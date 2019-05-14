<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Public_Controller {

  private $vars = [];

  public function __construct() {
    parent::__construct();
    $this->load->model([
      'm_profile',
      'm_information',
      'm_links',
      'm_posts',
      'm_jurusan',
      'm_headmaster',
      'm_photos',
      'm_navigations',
      'm_prestasi',
      'm_albums',
      'm_photos',
      'm_alumni',
    ]);
    $this->load->helper(['datetime']);
  }

  public function index() {
    $name = $this->uri->segment(4);
    $id = $this->uri->segment(5);

    $data['page'] = $name;
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();
    $data['information'] = $this->m_information->get_all(4);
    $data['articles'] = $this->m_posts->get_all(4, 0);

    if ($name == 'article') {
      $table = 'posts';
      $data['article'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['article']->created_at);
      $data['content'] = 'public/articles/detail';
    }

    else if ($name == 'page') {
      $table = 'posts';
      $data['page'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['page']->created_at);
      $data['content'] = 'public/page/detail';
    }

    else if ($name == 'prestasi') {
      $table = 'posts';
      $data['prestasi'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['prestasi']->created_at);
      $data['content'] = 'public/prestasi/detail';
    }

    else if ($name == 'information') {
      $table = 'posts';
      $data['information'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['information']->created_at);
      $data['content'] = 'public/information/detail';
    }

    else if ($name == 'jurusan') {
      $table = 'posts';
      $data['jurusan'] = $this->model->get_row('id', $id, $table);
      $data['content'] = 'public/jurusan/detail';
    }

    else if ($name == 'album') {
      $data['album_title'] = $this->model->get_row('id', $id, 'albums')->title;
      $data['photos'] = $this->m_photos->get_by_album($id);
      $data['content'] = 'public/albums/detail';
    }

    else if ($name == 'articles') {
      $table = 'posts';
      $data['articles'] = $this->m_posts->get_all();
      $data['content'] = 'public/articles/index';
    }

    else if ($name == 'albums') {
      $data['albums'] = $this->m_albums->get_all();
      $data['content'] = 'public/albums/index';
    }
    
    else if ($name == 'all_information') {
      $table = 'posts';
      $data['information'] = $this->m_information->get_all();
      $data['content'] = 'public/information/index';
    }

    else if ($name == 'all_prestasi') {
      $table = 'posts';
      $data['prestasi'] = $this->m_prestasi->get_all();
      $data['content'] = 'public/prestasi/index';
    }

    else if ($name == 'alumni') {
      $alumni_jurusan = $this->uri->segment(5);
      $alumni_angkatan = $this->uri->segment(6);

      if ($alumni_jurusan AND ! $alumni_angkatan) {
        $data['jurusan'] = $this->model->get_row('id', $alumni_jurusan, 'posts')->title;
        $data['alumni'] = $this->m_alumni->getUniqAngkatanByJurusan($alumni_jurusan);
      } else if ($alumni_jurusan AND $alumni_angkatan) {
        $queryParam = ['jurusan_id' => $alumni_jurusan, 'angkatan' => $alumni_angkatan];
        $data['alumni'] = $this->m_alumni->getByJurusanAngkatan($queryParam);
      } else {
        $data['jurusan'] = $this->m_jurusan->get_all();
      }

      $data['alumni_jurusan'] = $alumni_jurusan;
      $data['alumni_angkatan'] = $alumni_angkatan;
      $data['content'] = 'public/alumni/index';
    }

    else if ($name == 'register_alumni') {
      $data['jurusan'] = $this->m_jurusan->get_all();
      $data['content'] = 'public/alumni/register';
      $data['action'] = site_url('public/page/save_alumni');
    }

    else {
      show_404();
    }

    $this->load->view('frontend/page', $data);
  }

  public function save_alumni() {
    if ($this->input->is_ajax_request()) {
      if ($this->alumni_validation()) {
        $table = 'alumni';
        $data = $this->get_alumni_post_data();

        // $this->tmp['upload_failed'] = FALSE;
        // if (! empty($_FILES['image'])) {
        //   $upload = $this->upload_image();
        //   if ($upload) {
        //     $data['image'] = $upload['file_name'];
        //   }
        // }

        // if ( ! $this->tmp['upload_failed']) {
          if ($this->model->create($table, $data)) {
            $this->vars['message'] = 'Registrasi Alumni berhasil';
            $this->vars['status'] = 'success';
            
          } else {
            $this->vars['message'] = 'Terjadi kesalahan saat registrasi data';
            $this->vars['status'] = 'failed';
          }
        // }

      } else {
        $this->vars['status'] = 'failed';
				$this->vars['message'] = validation_errors();
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  private function alumni_validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('name', 'Nama', 'trim|required');
    $val->set_rules('gender', 'Jenis Kelamin', 'trim|required');
    $val->set_rules('address', 'Alamat', 'trim|required');
    $val->set_rules('telp', 'No Telp', 'trim|required');
    $val->set_rules('angkatan', 'Angkatan', 'trim|required');
    $val->set_rules('jurusan_id', 'Jurusan', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    $val->set_message('required', '%s wajib diisi.');
    
		return $val->run();
  }

  private function get_alumni_post_data() {
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
      'is_verified' => 'false'
    ];
  }
}

?>