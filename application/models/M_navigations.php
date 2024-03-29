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

  public function client_get_all() {
    $navigations = $this->get_all();
    $new_navigations = [
      'single' => [],
      'dropdown' => []
    ];
    $tmp_nav_id = 0;
    $tmp_nav_counter = -1;

    foreach ($navigations as $row) {
      $nav_id = $row->nav_id;
      $nav_title = $row->nav_title;
      $post_id = $row->post_id;
      $post_title = $row->post_title;

      // Single Nav
      if ($nav_id == 0) {
        array_push($new_navigations['single'], [
          'post_id' => $post_id,
          'post_title' => $post_title
        ]);
      }
      // Dropdown Nav
      else {
        if ($nav_id != $tmp_nav_id) {
          $tmp_nav_id = $nav_id;
          $tmp_nav_counter += 1;

          // Init Dropdown Child Data
          array_push($new_navigations['dropdown'], [
            'nav_title' => $nav_title,
            'navs' => []
          ]);
          
          // First Item
          array_push($new_navigations['dropdown'][$tmp_nav_counter]['navs'], [
            'post_id' => $post_id,
            'post_title' => $post_title
          ]);
          
        } else {
          array_push($new_navigations['dropdown'][$tmp_nav_counter]['navs'], [
            'post_id' => $post_id,
            'post_title' => $post_title
          ]);
        }
      }
    }
    return $new_navigations;
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

  public function delete_page($id) {
    $this->db->trans_start();

    $this->db->where('post_id', $id);
    $this->db->delete(self::$table_pages);

    $this->db->where('id', $id);
    $this->db->delete(self::$table_posts);

    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function delete_nav($id) {
    $this->db->trans_start();

    $this->db->where('id', $id);
    $this->db->delete(self::$table);

    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  public function count_by_nav($id) {
    return $this->db->where('nav_id', $id)->count_all_results(self::$table_pages);
  }

  public function count_all() {
    return $this->db->count_all(self::$table_pages);
  }
}

?>