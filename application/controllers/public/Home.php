<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

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
    ]);
    $this->load->helper(['datetime']);
  }

  public function index() {
    $data = [
      'profile' => $this->m_profile->get(),
      'headmaster' => $this->m_headmaster->get(),
      'information' => $this->m_information->get_all(4),
      'links' => $this->m_links->get_all(),
      'articles' => $this->m_posts->get_all(4, 4),
      'slideshow' => $this->m_posts->get_all(4, 0),
      'jurusan' => $this->m_jurusan->get_all(),
      'photos' => $this->m_photos->get_all(6, 0),
      'navigations' => $this->m_navigations->client_get_all(),
      'prestasi' => $this->m_prestasi->get_all(2, 0),
    ];

    $this->load->view('frontend/home', $data);
  }
}

?>