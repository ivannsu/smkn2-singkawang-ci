<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_students extends CI_Model {
  public static $pk = 'id';
  public static $pk_user = 'user_id';
  public static $table = 'students';

  public function __construct() {
    parent::__construct();
  }

  public function get_all_candidates($limit = '18446744073709551615', $offset = '0') {
    return $this->db
      ->select('
        x1.*,
        x2.id,
        x2.name,
        x2.email,
        x2.level,
        x3.id,
        x3.title as jurusan
      ')
      ->join('users x2', 'x1.user_id = x2.id', 'LEFT')
      ->join('posts x3', 'x1.jurusan_id = x3.id', 'LEFT')
      ->where('x1.is_candidate', 'true')
      ->order_by('x1.id', 'DESC')
      ->limit($limit, $offset)
      ->get(self::$table . ' x1')
      ->result();
  }

  public function get_by_user($user_id) {
    return $this->db
      ->select('
        x1.*,
        x2.id,
        x2.name,
        x2.email,
        x2.level,
        x3.id,
        x3.title as jurusan
      ')
      ->join('users x2', 'x1.user_id = x2.id', 'LEFT')
      ->join('posts x3', 'x1.jurusan_id = x3.id', 'LEFT')
      ->where('x1.user_id', $user_id)
      ->get(self::$table . ' x1')
      ->row();
  }

  public function current_candidate_step($user_id) {
    return $this->db
      ->select('x1.current_candidate_step')
      ->where('user_id', $user_id)
      ->get(self::$table . ' x1')
      ->row()
      ->current_candidate_step;
  }

  public function update($table, $data, $value) {
    $this->db->trans_start();
    $this->db->where(self::$pk_user, $value);
    $this->db->update($table, $data);
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  // public function count_all() {
  //   return $this->db
  //     ->where('type', 'article')
  //     ->from(self::$table)
  //     ->count_all_results();
  // }
}

?>