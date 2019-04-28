<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {
  public static $pk = 'id';
  public static $pk_val = '1';
  public static $table = 'profile';

  public function __construct() {
    parent::__construct();
  }

  public function get_all($limit = '18446744073709551615', $offset = '0') {
    return $this->db
      ->order_by(self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get(self::$table)
      ->result();
  }
}

?>