<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $data = [
      'title' => 'Dashboard',
      'content' => 'dashboard/index'
    ];
    $this->load->view('backend/index', $data);
  }
}

?>