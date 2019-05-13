<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admission extends CI_Model {
  public static $pk = 'id';
  public static $table = 'admission_phases';

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

  public function set_active_phase($id) {
    $this->db->trans_start();

    // Set all to false
    $this->db->update(self::$table, ['active' => 'false']);

    // Then update where row = $id
    $this->db->where(self::$pk, $id);
    $this->db->update(self::$table, ['active' => 'true']);

    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function get_active_phase() {
    return $this->db
      ->where('active', 'true')
      ->get(self::$table)
      ->row();
  }

  // public function count_all() {
  //   return $this->db
  //     ->where('type', 'article')
  //     ->from(self::$table)
  //     ->count_all_results();
  // }
}

?>