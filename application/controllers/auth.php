<?php

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        define('CURRENT_CONTEXT', base_url() . 'auth/');
        init_generic_dao();
        $this->load->helper(array('form', 'url', 'html','captcha'));
        $this->load->model('m_user', '', TRUE);
        $this->load->library('session');
        $this->data['page_title'] = "Login";
        $this->data['current_context'] = CURRENT_CONTEXT;
    }

    function index() {
        if (($this->session->userdata('logged_in') == TRUE)) {
            redirect('dashboard');
        } else {
            $this->data['message'] = "";
           // $this->data['captcha'] = $this->create_captcha();
            $this->load->view('login', $this->data);
        }
    }

    function Login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->m_user->check_login($username, $password);
        if ($result == TRUE) {
           // $user = $this->m_user->by_id(array('username'=>$username));
            $newdata = array(
                'username' => $username,
                'id_user' => $result->id_user,
                'role_id' => $result->role_id,
                'full_name'=>$result->full_name,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            redirect('dashboard');
        } else {
            $this->data['message'] = "Login Gagal, Silahkan Coba Lagi!";
            $this->load->view('login', $this->data);
        }
    }

    function logout() {
        $newdata = array(
            'username' => '',
            'logged_in' => FALSE
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        redirect('auth');
    }

    function create_captcha(){
        $config = array(
            'img_path'      => 'captcha/',
            'img_url'       => base_url().'captcha/',
            'img_width'     => '100',
            'img_height'    => 47,
            'word_length'   => 4,
            'font_size'     => 20
        );
        $captcha = create_captcha($config);
        $image = $captcha['image'];
        $this->session->set_userdata('captchaword', $captcha['word']);

        date_default_timezone_set("Asia/Jakarta");
        $expiration = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' +2 minutes'));
        $this->session->set_userdata('captcha_expiration', $expiration);
        return $image;
    }

}

?>