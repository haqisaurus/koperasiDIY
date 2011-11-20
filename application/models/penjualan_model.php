<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of penjualan_model
 *
 * @author haqisaurus
 */
class Penjualan_model extends CI_Model {

    //put your code here
    var $table_penjualan = "penjualan";
    var $table_hutang = "hutang";

    function __construct() {
        parent::__construct();
    }

    function insertPenjualanUmum($data) {
        $this->db->insert($this->table_penjualan, $data);
    }

    function insertPenjualanAnggota($data) {
        $this->db->insert($this->table_hutang, $data);
    }

    function updatePenjualanUmum($penjualan_id, $data) {
        $this->db->where('penjualan_id', $penjualan_id);
        $this->db->update($this->table_penjualan, $data);
    }

    function updatePenjualanAnggota($nip, $data) {
        $this->db->where('nip', $nip);
        $this->db->update($this->table_hutang, $data);
    }

    function updateBarangTerjual($kode_barang, $jumlahTerjual) {
        $this->db->query("UPDATE `barang` SET `jumlah` = `jumlah` - " . $jumlahTerjual . " WHERE `kode_barang` = '" . $kode_barang . "'");
    }

    function deletePenjualanUmum($penjualan_id) {
        $this->db->where('penjualan_id', $penjualan_id);
        $this->db->delete($this->table_penjualan);
    }

    function deletePenjualanAnggota($nip) {
        $this->db->where('nip', $nip);
        $this->db->delete($this->table_hutang);
    }

    function getAllPenjualan($limit, $offset) {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join($this->table_penjualan, 'barang.kode_barang = penjualan.kode_barang');
        $this->db->order_by('tanggal', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function getAllHutang($limit, $offset) {
        $this->db->select('hutang.nip,user.nama,barang.nama_barang,barang.kode_barang,hutang.jumlah,hutang.harga_jual,hutang.tanggal');
        $this->db->from($this->table_hutang);
        $this->db->join('barang', 'barang.kode_barang = hutang.kode_barang');
        $this->db->join('user', 'user.nip = hutang.nip');
        $this->db->order_by('tanggal', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function countPenjualan() {
        return $this->db->count_all($this->table_penjualan);
    }
    function countHutang() {
        return $this->db->count_all($this->table_penjualan);
    }

    /* for ajax function */

    function getFromKode($kode_barang) {
        $this->db->select('kode_barang,nama_barang,harga_beli');
        $this->db->like('kode_barang', $kode_barang, 'after');
        return $this->db->get('barang');
    }

    function getFromNama($nama_barang) {
        $this->db->select('kode_barang,nama_barang,harga_beli,jumlah');
        $this->db->like('nama_barang', $nama_barang, 'after');
        return $this->db->get('barang');
    }

    function getFromNIP($nip) {
        $this->db->select('nip,nama');
        $this->db->like('nip', $nip, 'after');
        return $this->db->get('user');
    }

}

?>