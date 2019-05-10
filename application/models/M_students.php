<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_students extends CI_Model {
  public static $pk = 'id';
  public static $pk_user = 'user_id';
  public static $table = 'students';

  public function __construct() {
    parent::__construct();
  }

  public function update($table, $data, $value) {
    $this->db->trans_start();
    $this->db->where(self::$pk_user, $value);
    $this->db->update($table, $data);
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  // public function get_all($limit = '18446744073709551615', $offset = '0') {
  //   return $this->db
  //     ->where('type', 'article')
  //     ->order_by(self::$pk, 'DESC')
  //     ->limit($limit, $offset)
  //     ->get(self::$table)
  //     ->result();
  // }

  // public function count_all() {
  //   return $this->db
  //     ->where('type', 'article')
  //     ->from(self::$table)
  //     ->count_all_results();
  // }
}

?>