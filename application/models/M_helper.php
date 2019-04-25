<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_helper extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  public function create($table, $data) {
    $this->db->trans_start();
    $this->db->insert($table, $data);
    $this->db->trans_complete();

    return $this->db->trans_status();
  }
}

?>