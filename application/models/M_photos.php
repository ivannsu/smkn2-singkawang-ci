<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_photos extends CI_Model {
  public static $pk = 'id';
  public static $fk_album = 'album_id';
  public static $table = 'photos';

  public function __construct() {
    parent::__construct();
  }

  public function get_by_album($id, $limit = '18446744073709551615', $offset = '0') {
    return $this->db
      ->where(self::$fk_album, $id)
      ->order_by(self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get(self::$table)
      ->result();
  }
}

?>