<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author haqisaurus
 */
class Login extends CI_Controller {

    //put your code here
    /**
     * Constructor
     */

    function __construct() {
        parent::__construct();
        $this->load->model('login_model', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('login') == TRUE) {
            redirect('home');
        } else {
            $this->load->view('login/login_view');
        }
    }

    /**
     * Memproses login
     */
    function process_login() {
    	
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->login_model->chekUser($username, $password) == TRUE) {
                foreach( $this->login_model->selectGroup($username,$password)->result() as $group){}
                $data = array('username' => $username, 'login' => TRUE,'group_id'=>$group->group_id);
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', 'Maaf, username dan atau password Anda salah');
                redirect('/login/login/');
            }
        } else {
            $this->load->view('login/login_view');
        }
    }

    /**
     * Memproses logout
     */
    function process_logout() {
        $this->session->sess_destroy();
        redirect('/login/login/', 'refresh');
    }

    
    

}

// END Login Class