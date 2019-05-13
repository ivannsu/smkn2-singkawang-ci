<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {
  private $pk = '';
  private $table = '';
  private $vars = [];

  public  function __construct() {
    parent::__construct();
    $this->load->model([
      'm_users'
    ]);
    $this->pk = M_users::$pk;
    $this->table = M_users::$table;
  }

  public function index() {
    $data = [
      'content' => 'login/login',
      'title' => 'Login',
      'action' => site_url('login/login_action')
    ];

    $this->load->view('login/index', $data);
  }

  public function login_action() {
    if ($this->input->is_ajax_request()) {
      if ($this->login_validation()) {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $user = $this->m_users->getByUsernameOREmail($username);

        if ($user->num_rows() > 0) {
          $user_data = $user->row();
          $check_password = password_verify($password, $user_data->password);

          if ($check_password) {
            $this->session->set_userdata([
              'user_id' => $user_data->id,
              'user_level' => $user_data->level
            ]);

            if ($user_data->level == 'ADMIN') {
              $this->vars['redirect_link'] = site_url('dashboard');
            } else if ($user_data->level == 'STUDENTS') {
              $this->vars['redirect_link'] = site_url('welcome');
            } else if ($user_data->level == 'CANDIDATE_STUDENTS') {
              $this->vars['redirect_link'] = site_url('public/ppdb/');
            }
            
            $this->vars['message'] = 'Login berhasil, Redirect dalam 3 detik';
            $this->vars['status'] = 'success';
          } else {
            $this->vars['message'] = 'Username atau Password Salah';
            $this->vars['status'] = 'failed';
          }
        } else {
          $this->vars['message'] = 'Username atau Password Salah';
          $this->vars['status'] = 'failed';
        }

      } else {
        $this->vars['status'] = 'failed';
				$this->vars['message'] = validation_errors();
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  // public function register() {
  //   $data = [
  //     'content' => 'login/register',
  //     'title' => 'Daftar',
  //     'action' => site_url('login/register_action')
  //   ];

  //   $this->load->view('login/index', $data);
  // }

  public function register_action() {
    if ($this->input->is_ajax_request()) {
      if ($this->validation()) {
        $data = $this->get_post_data();

        if ($this->model->create($this->table, $data)) {
          $this->vars['message'] = 'Pendaftaran berhasil';
          $this->vars['status'] = 'success';
          
        } else {
          $this->vars['message'] = 'Terjadi kesalahan saat melakukan pendaftaran';
          $this->vars['status'] = 'failed';
        }

      } else {
        $this->vars['status'] = 'failed';
				$this->vars['message'] = validation_errors();
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  public function logout() {
    $this->session->unset_userdata(['user_id', 'user_level']);
    session_destroy();

    redirect('login');
  }

  public function change_password() {
    $level = $this->session->user_level;

    if ($level == 'ADMIN' OR $level == 'STUDENTS' OR $level == 'CONTRIBUTORS') {
      $data = [
        'title' => 'Ubah Password',
        'content' => 'login/change_password',
        'action' => site_url('login/change_password_action')
      ];
  
      $this->load->view('backend/index', $data);
    } else {
      show_404();
    }
  }

  public function change_password_action() {
    if ($this->input->is_ajax_request()) { 
      $user_id = $this->session->user_id;
      $old_password = $this->input->post('old_password', true);
      $new_password = password_hash($this->input->post('new_password', true), PASSWORD_DEFAULT);

      $user = $this->model->get_row($this->pk, $user_id, $this->table);
      $verify = password_verify($old_password, $user->password);

      if ($verify) {
        $update = $this->model->update($this->table, ['password' => $new_password], $user_id);

        if ($update) {
          $this->vars['message'] = 'Sukses mengubah password';
          $this->vars['status'] = 'success';

          $this->session->unset_userdata(['user_id', 'user_level']);
          session_destroy();
        } else {
          $this->vars['message'] = 'Terjadi kesalahan saat mengubah password';
          $this->vars['status'] = 'failed';
        }
      } else {
        $this->vars['message'] = 'Password anda salah';
        $this->vars['status'] = 'failed';
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    } else {
      show_404();
    }
  }

  private function validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('name', 'Name', 'trim|required');
    $val->set_rules('email', 'Email', 'trim|required');
    $val->set_rules('username', 'Username', 'trim|required');
    $val->set_rules('password', 'Password', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
    return $val->run();
  }

  private function login_validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('username', 'Username', 'trim|required');
    $val->set_rules('password', 'Password', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');
    
    return $val->run();
  }

  private function get_post_data() {
    return [
      'name' => $this->input->post('name', true),
      'email' => $this->input->post('email', true),
      'username' => $this->input->post('username', true),
      'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
      'level' => 'STUDENTS'
    ];
  }

}

?>