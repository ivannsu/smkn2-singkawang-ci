<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_posts extends CI_Model {
  public static $pk = 'id';
  public static $table = 'posts';

  public function __construct() {
    parent::__construct();
  }

  public function get_all($limit = '18446744073709551615', $offset = '0') {
    return $this->db
      ->select('
        x1.*,
        x2.name as author_name
      ')
      ->join('users x2', 'x1.author = x2.id')
      ->where('type', 'article')
      ->order_by(self::$pk, 'DESC')
      ->limit($limit, $offset)
      ->get(self::$table . ' x1')
      ->result();
  }

  public function count_all() {
    return $this->db
      ->where('type', 'article')
      ->from(self::$table)
      ->count_all_results();
  }
}

?>