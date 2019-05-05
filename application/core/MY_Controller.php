<?php

class MY_Controller extends CI_Controller {
  public function __construct() {
    parent::__construct();
    
		$timezone = 'Asia/Jakarta';
    date_default_timezone_set($timezone);
  }
}

require_once(APPPATH.'/core/Public_Controller.php');
require_once(APPPATH.'/core/Admin_Controller.php');

?>