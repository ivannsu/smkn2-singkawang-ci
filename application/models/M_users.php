<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {
  public static $pk = 'id';
  public static $table = 'users';

  public function __construct() {
    parent::__construct();
  }

  public function getByUsername($username) {
    return $this->db
      ->where('username', $username)
      ->get(self::$table);
  }
}

?>