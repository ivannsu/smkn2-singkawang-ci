<?php

class Admin_Controller extends MY_Controller {
  public function __construct() {
    parent::__construct();

    if ( ! $this->session->user_level) {
      redirect('login');
    }
  }
}

?>