<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_navigations extends CI_Model {
  public static $pk = 'id';
  public static $table = 'navigations';
  public static $table_posts = 'posts';
  public static $table_pages = 'pages';

  public function __construct() {
    parent::__construct();
  }

  public function get_all($limit = '18446744073709551615', $offset = '0') {
    return $this->db
    ->query('
      SELECT posts.*, navigations.*, pages.*,
      navigations.title as nav_title,
      posts.title as post_title,
      pages.id as page_id
      FROM pages 
      INNER JOIN navigations ON pages.nav_id = navigations.id
      INNER JOIN posts ON posts.id = pages.post_id
      ORDER BY pages.nav_id ASC
    ')->result();
  }

  public function create($data) {
    $this->db->insert(self::$table, $data);
    return $this->db->insert_id();
  }

  public function create_page($data, $nav_id) {
    $this->db->trans_start();

    // Insert to Posts first & get the last id
    $this->db->insert(self::$table_posts, $data);
    $post_id = $this->db->insert_id();

    // Insert to Pages
    $page_data = [
      'post_id' => $post_id,
      'nav_id' => $nav_id
    ];
    $this->db->insert(self::$table_pages, $page_data);

    $this->db->trans_complete();
    return $this->db->trans_status();
  }
}

?>