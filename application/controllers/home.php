<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author haqisaurus
 */
class Home extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['content']= "home/home_content_view";
        $data['test'] ="saya lagi pergi";
        $this->load->view('home_view', $data);
    }

}

?>
