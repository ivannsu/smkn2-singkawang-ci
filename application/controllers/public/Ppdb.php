<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppdb extends Public_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model([
      'm_profile',
      'm_navigations',
    ]);
  }

  public function index() {
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->m_navigations->client_get_all();

    $this->load->view('frontend/ppdb', $data);
  }
}

?>