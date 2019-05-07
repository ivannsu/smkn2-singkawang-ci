<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Public_Controller {

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
      'm_prestasi',
      'm_albums',
      'm_photos',
    ]);
    $this->load->helper(['datetime']);
  }

  public function index() {
    $name = $this->uri->segment(4);
    $id = $this->uri->segment(5);

    $data['page'] = $name;
    $data['profile'] = $this->m_profile->get();
    $data['navigations'] = $this->generate_navigations();
    $data['information'] = $this->m_information->get_all(4);
    $data['articles'] = $this->m_posts->get_all(4, 0);

    if ($name == 'article') {
      $table = 'posts';
      $data['article'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['article']->created_at);
      $data['content'] = 'public/articles/detail';
    }

    else if ($name == 'page') {
      $table = 'posts';
      $data['page'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['page']->created_at);
      $data['content'] = 'public/page/detail';
    }

    else if ($name == 'prestasi') {
      $table = 'posts';
      $data['prestasi'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['prestasi']->created_at);
      $data['content'] = 'public/prestasi/detail';
    }

    else if ($name == 'information') {
      $table = 'posts';
      $data['information'] = $this->model->get_row('id', $id, $table);
      $data['created_at'] = explode(' ', $data['information']->created_at);
      $data['content'] = 'public/information/detail';
    }

    else if ($name == 'jurusan') {
      $table = 'posts';
      $data['jurusan'] = $this->model->get_row('id', $id, $table);
      $data['content'] = 'public/jurusan/detail';
    }

    else if ($name == 'album') {
      $data['album_title'] = $this->model->get_row('id', $id, 'albums')->title;
      $data['photos'] = $this->m_photos->get_by_album($id);
      $data['content'] = 'public/albums/detail';
    }

    else if ($name == 'articles') {
      $table = 'posts';
      $data['articles'] = $this->m_posts->get_all();
      $data['content'] = 'public/articles/index';
    }

    else if ($name == 'albums') {
      $data['albums'] = $this->m_albums->get_all();
      $data['content'] = 'public/albums/index';
    }
    
    else if ($name == 'all_information') {
      $table = 'posts';
      $data['information'] = $this->m_information->get_all();
      $data['content'] = 'public/information/index';
    }

    else if ($name == 'all_prestasi') {
      $table = 'posts';
      $data['prestasi'] = $this->m_prestasi->get_all();
      $data['content'] = 'public/prestasi/index';
    }

    else {
      $data['content'] = 'public/404';
    }

    $this->load->view('frontend/page', $data);
  }

  private function generate_navigations() {
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
    return $new_navigations;
  }
}

?>