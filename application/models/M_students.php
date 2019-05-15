<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_students extends CI_Model {
  public static $pk = 'id';
  public static $pk_user = 'user_id';
  public static $table = 'students';

  public function __construct() {
    parent::__construct();
  }

  public function get_all_candidates($type = '', $limit = '18446744073709551615', $offset = '0') {
    $this->db
      ->select('
        x1.*,
        x2.id,
        x2.name,
        x2.email,
        x2.level,
        x3.id,
        x3.title as jurusan,
        x4.id,
        x4.active
      ')
      ->join('users x2', 'x1.user_id = x2.id', 'LEFT')
      ->join('posts x3', 'x1.jurusan_id = x3.id', 'LEFT')
      ->join('admission_phases x4', 'x1.admission_phase_id = x4.id')
      ->where('x1.is_candidate', 'true')
      ->where('x4.active', 'true');

    if ($type == 'selection') {
      // For select verified (val: 4) candidates data
      $this->db
        ->where('x1.current_candidate_step', 4)
        ->where('x1.passed_selection', 'on_going');
    } 
    else if ($type == 'passed') {
      $this->db
        ->where('x1.current_candidate_step', 4)
        ->where('x1.passed_selection', 'passed');
    } 
    else if ($type == 'not_passed') {
      $this->db
        ->where('x1.current_candidate_step', 4)
        ->where('x1.passed_selection', 'not_passed');
    } 
    else {
      $this->db->order_by('x1.id', 'DESC');
    }

    return $this->db  
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

  public function count_candidates_selection_by_jurusan($type = 'not_passed') {
    $this->db
      ->select('
        COUNT(x1.id) as total_students,
        x1.jurusan_id,
        x2.title as jurusan,
      ')
      ->join('posts x2', 'x1.jurusan_id = x2.id', 'LEFT');

    if ($type == 'selection') {
      $this->db
        ->where('x1.current_candidate_step', 4)
        ->where('x1.passed_selection', 'on_going');
    } 
    else if ($type == 'passed') {
      $this->db
        ->where('x1.current_candidate_step', 4)
        ->where('x1.passed_selection', 'passed');
    } 
    else if ($type == 'not_passed') {
      $this->db
        ->where('x1.current_candidate_step', 4)
        ->where('x1.passed_selection', 'not_passed');
    } 
    
    return $this->db
      ->group_by('x1.jurusan_id')
      ->get(self::$table . ' x1')
      ->result();
  }
}

?>