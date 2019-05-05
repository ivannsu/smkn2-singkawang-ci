<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model([
      'm_albums',
      'm_information',
      'm_jurusan',
      'm_links',
      'm_navigations',
      'm_posts',
      'm_prestasi'
    ]);
  }

  public function index() {
    $counts = [
      'albums' => $this->m_albums->count_all(),
      'information' => $this->m_information->count_all(),
      'jurusan' => $this->m_jurusan->count_all(),
      'links' => $this->m_links->count_all(),
      'navigations' => $this->m_navigations->count_all(),
      'posts' => $this->m_posts->count_all(),
      'prestasi' => $this->m_prestasi->count_all(),
    ];

    $data = [
      'title' => 'Dashboard',
      'content' => 'dashboard/index',
      'counts' => $counts
    ];
    $this->load->view('backend/index', $data);
  }
}

?>