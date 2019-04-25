<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_posts extends CI_Model {
  public static $pk = 'id';
  public static $table = 'posts';

  public function __construct() {
    parent::__construct();
  }
}

?>