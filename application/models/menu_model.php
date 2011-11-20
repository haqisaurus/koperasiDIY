<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_model
 *
 * @author haqisaurus
 */
class Menu_model extends CI_Model {

    var $table = "menu m";
    var $table1 = "rel_menu_group g";

    function __construct() {
        parent::__construct();
    }

    function getMenu($parent, $group_id) {
        $this->db->select('m.menu_id,m.menu_name,m.menu_path');
        $this->db->from($this->table.",".$this->table1);
        $this->db->where('g.menu_id = m.menu_id');
        $this->db->where('m.menu_id_rel' , $parent);
        $this->db->where('g.group_id', $group_id);
        $this->db->order_by("m.menu_urut", "asc");
        return $this->db->get();
    }

    //put your code here
}

?>
