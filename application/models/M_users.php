<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {
  public static $pk = 'id';
  public static $table = 'users';

  public function __construct() {
    parent::__construct();
  }

  public function getByUsernameOREmail($username) {
    return $this->db
      ->where('username', $username)
      ->or_where('email', $username)
      ->get(self::$table);
  }

  public function getByUsername($username) {
    return $this->db
      ->where('username', $username)
      ->get(self::$table);
  }

  public function getByEmail($email) {
    return $this->db
      ->where('email', $email)
      ->get(self::$table);
  }

  public function create_candidate_student_account($data) {
    $this->db->trans_start();

    $this->db->insert(self::$table, $data);

    // Last Insert User ID
    $user_id = $this->db->insert_id();
    
    // Create New Candidate Student
    $student = [
      'user_id' => $user_id,
      'registration_id' => uniqid(rand()),
      'is_candidate' => 'true'
    ];
    $this->db->insert('students', $student);

    $this->db->trans_complete();
    return $this->db->trans_status();
  }
}

?>