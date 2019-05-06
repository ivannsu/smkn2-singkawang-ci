<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {
  public static $pk = 'id';
  public static $pk_val = '1';
  public static $table = 'profile';

  public function __construct() {
    parent::__construct();
  }

  public function get() {
    return $this->db
      ->where(self::$pk, self::$pk_val)
      ->get(self::$table)
      ->row();
  }
}

?>