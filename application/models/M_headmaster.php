<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_headmaster extends CI_Model {
  public static $pk = 'id';
  public static $pk_val = '1';
  public static $table = 'headmaster';

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

  public function get() {
    return $this->db
      ->where(self::$pk, self::$pk_val)
      ->get(self::$table)
      ->row();
  }
}

?>