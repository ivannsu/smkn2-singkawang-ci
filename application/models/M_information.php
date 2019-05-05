<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_information extends CI_Model {
  public static $pk = 'id';
  public static $table = 'posts';

  public function __construct() {
    parent::__construct();
  }

  public function get_all($limit = '18446744073709551615', $offset = '0') {
    return $this->db
      ->where('type', 'information')
      ->order_by(self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get(self::$table)
      ->result();
  }

  public function count_all() {
    return $this->db
      ->where('type', 'information')
      ->from(self::$table)
      ->count_all_results();
  }
}

?>