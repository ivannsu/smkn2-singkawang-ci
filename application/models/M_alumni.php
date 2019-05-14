<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_alumni extends CI_Model {
  public static $pk = 'id';
  public static $table = 'alumni';

  public function __construct() {
    parent::__construct();
  }

  public function get_all($verified = '', $limit = '18446744073709551615', $offset = '0') {
    $this->db
      ->select('*, posts.title as jurusan, alumni.id as alumni_id')
      ->from(self::$table)
      ->join('posts', 'posts.id = alumni.jurusan_id');

    if ($verified != '') {
      $this->db->where('is_verified', $verified);
    }

    return $this->db->
      order_by('alumni.'.self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get()
      ->result();
  }

  public function get_by_id($id) {
    return $this->db
      ->select('*, posts.title as jurusan, alumni.id as alumni_id')
      ->from(self::$table)
      ->join('posts', 'posts.id = alumni.jurusan_id')
      ->where('alumni.'.self::$pk, $id)
      ->get()
      ->row();
  }

  public function getByJurusan($jurusan_id, $limit = '18446744073709551615', $offset = '0') {
    // where is verified only for client side, PLEASE NOTE THIS

    return $this->db
      ->where('jurusan_id', $jurusan_id)
      ->where('is_verified', 'true')
      ->order_by(self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get(self::$table)
      ->result();
  }

  public function getByJurusanAngkatan($data, $limit = '18446744073709551615', $offset = '0') {
    $jurusan_id = $data['jurusan_id'];
    $angkatan = $data['angkatan'];

    // where is verified only for client side, PLEASE NOTE THIS

    return $this->db
      ->select('*, posts.title as jurusan, alumni.image as alumni_image')
      ->from(self::$table)
      ->join('posts', 'posts.id = alumni.jurusan_id')
      ->where('jurusan_id', $jurusan_id)
      ->where('is_verified', 'true')
      ->where('angkatan', $angkatan)
      ->order_by('alumni.'.self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get()
      ->result();
  }

  public function getUniqAngkatanByJurusan($jurusan_id) {
    // where is verified only for client side, PLEASE NOTE THIS
    
    return $this->db
      ->distinct()
      ->select('angkatan')
      ->where('jurusan_id', $jurusan_id)
      ->where('is_verified', 'true')
      ->order_by(self::$pk, 'DESC')
      ->get(self::$table)
      ->result();
  }
}

?>