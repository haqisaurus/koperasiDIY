<?php

/*
 * Created on Nov 18, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Barang_model extends CI_model {

    var $table = 'barang';

    function __construct() {
        parent :: __construct();
    }

    function insertBarang($data) {
        $this->db->insert($this->table, $data);
    }

    function updateBarang($kode_barang, $data) {
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update($this->table, $data);
    }

    function deleteBarang($kode_barang) {
        $this->db->where('kode_barang', $kode_barang);
        $this->db->delete($this->table);
    }

    function countBarang() {
        return $this->db->count_all($this->table);
    }

    function cekKodeBarang($kode_barang) {
        $query = $this->db->get_where($this->table, array('kode_barang' => $kode_barang), 1, 0);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getAllBarang($limit, $offset) {
        $this->db->order_by('tanggal_masuk', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table);
    }

    function getDataUpdate($kode_barang) {
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get($this->table);
    }

}

?>
