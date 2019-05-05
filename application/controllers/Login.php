<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
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

        $user = $this->m_users->getByUsername($username);

        if ($user->num_rows() > 0) {
          $user_data = $user->row();
          $check_password = password_verify($password, $user_data->password);

          if ($check_password) {
            $this->session->set_userdata([
              'user_id' => $user_data->id,
              'user_level' => $user_data->level
            ]);
            
            $this->vars['message'] = 'Login berhasil, Redirect dalam 3 detik';
            $this->vars['status'] = 'success';
            $this->vars['level'] = $user_data->level;
          } else {
            $this->vars['message'] = 'Username atau Password Salah';
            $this->vars['status'] = 'failed';
          }
        } else {
          $this->vars['message'] = 'Username atau Password Salah';
          $this->vars['status'] = 'failed';
        }

        // $data = $this->get_post_data();

        // if ($this->model->create($this->table, $data)) {
        //   $this->vars['message'] = 'Pendaftaran berhasil';
        //   $this->vars['status'] = 'success';
          
        // } else {
          // $this->vars['message'] = 'Terjadi kesalahan saat melakukan pendaftaran';
          // $this->vars['status'] = 'failed';
        // }

      } else {
        $this->vars['status'] = 'failed';
				$this->vars['message'] = validation_errors();
      }

      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->vars));
    }
  }

  public function register() {
    $data = [
      'content' => 'login/register',
      'title' => 'Daftar',
      'action' => site_url('login/register_action')
    ];

    $this->load->view('login/index', $data);
  }

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

  private function validation() {
    $this->load->library('form_validation');

    $val = $this->form_validation;
    $val->set_rules('name', 'Name', 'trim|required');
    $val->set_rules('email', 'Email', 'trim|required');
    $val->set_rules('username', 'Username', 'trim|required');
    $val->set_rules('password', 'Password', 'trim|required');
    $val->set_error_delimiters('<div>&sdot; ', '</div>');

    // name
    // email
    // username
    // password
    // confirm_password
    
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