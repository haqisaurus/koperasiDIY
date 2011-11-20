<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author haqisaurus
 */
class login_model extends CI_Model {

    //put your code here
    var $table = "user";

    function __construct() {
        parent::__construct();
    }

    function chekUser($username, $password) {
        $query = $this->db->get_where($this->table, array('username' => $username, 'password' => md5($password)), 1, 0);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function selectGroup($username, $password) {
        $this->db->select('group_id');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        return $this->db->get();
    }

    

}

?>
