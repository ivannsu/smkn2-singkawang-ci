<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_helper extends CI_Model {

  public static $pk = 'id';

  public function __construct() {
    parent::__construct();
  }

  public function create($table, $data) {
    $this->db->trans_start();
    $this->db->insert($table, $data);
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function update($table, $data, $value) {
    $this->db->trans_start();
    $this->db->where(self::$pk, $value);
    $this->db->update($table, $data);
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function delete($table, $value) {
    $this->db->trans_start();
    $this->db->where(self::$pk, $value);
    $this->db->delete($table);
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function get_row($key, $value, $table) {
    return $this->db
      ->where($key, $value)
      ->get($table)
      ->row();
  }

  public function count_all($table) {
    return $this->db->count_all($table);
  }
}

?>