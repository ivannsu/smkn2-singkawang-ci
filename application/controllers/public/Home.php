<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model([
      'm_profile',
      'm_information',
      'm_links',
      'm_posts',
      'm_jurusan',
      'm_headmaster',
      'm_photos',
      'm_navigations',
    ]);
    $this->load->helper(['datetime']);
  }

  public function index() {
    $data = [
      'profile' => $this->m_profile->get(),
      'headmaster' => $this->m_headmaster->get(),
      'information' => $this->m_information->get_all(5),
      'links' => $this->m_links->get_all(),
      'articles' => $this->m_posts->get_all(4, 4),
      'slideshow' => $this->m_posts->get_all(4, 0),
      'jurusan' => $this->m_jurusan->get_all(),
      'photos' => $this->m_photos->get_all(6, 0),
    ];

    $navigations = $this->m_navigations->get_all();
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
    $data['navigations'] = $new_navigations;

    $this->load->view('frontend/home', $data);
  }
}

?>