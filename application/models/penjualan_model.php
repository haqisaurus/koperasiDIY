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
    var $table_pembelian_anggota = "pembelian_anggota";

    function __construct() {
        parent::__construct();
    }

    function insertPenjualanUmum($data) {
        $this->db->insert($this->table_penjualan, $data);
    }

    function insertPenjualanAnggota($data) {
        $this->db->insert($this->table_pembelian_anggota, $data);
    }

//    input ke hutang
    function insertHutang($data) {
        $this->db->insert('pembayaran_hutang', $data);
    }

//    end input ke hutang

    function updatePenjualanUmum($penjualan_id, $data) {
        $this->db->where('penjualan_id', $penjualan_id);
        $this->db->update($this->table_penjualan, $data);
    }

    function updatePenjualanAnggota($nip, $data) {
        $this->db->where('nip', $nip);
        $this->db->update($this->table_pembelian_anggota, $data);
    }

    function updateBarangTerjual($kode_barang, $jumlahTerjual) {
        $this->db->query("UPDATE `barang` SET `jumlah` = `jumlah` - " . $jumlahTerjual . " WHERE `kode_barang` = '" . $kode_barang . "'");
    }

    function updateStatusLunas($data,$hutang_id) {
        $this->db->where('hutang_id', $hutang_id);
        $this->db->update($this->table_pembelian_anggota, $data);
    }

    function deletePenjualanUmum($penjualan_id) {
        $this->db->where('penjualan_id', $penjualan_id);
        $this->db->delete($this->table_penjualan);
    }

    function deletePenjualanAnggota($nip) {
        $this->db->where('nip', $nip);
        $this->db->delete($this->table_pembelian_anggota);
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
        $this->db->select('pembelian_anggota.hutang_id,pembelian_anggota.nip,user.nama,barang.nama_barang,barang.kode_barang,pembelian_anggota.jumlah,pembelian_anggota.harga_jual,pembelian_anggota.status_bayar,pembelian_anggota.status_lunas,pembelian_anggota.tanggal');
        $this->db->from($this->table_pembelian_anggota);
        $this->db->join('barang', 'barang.kode_barang = pembelian_anggota.kode_barang');
        $this->db->join('user', 'user.nip = pembelian_anggota.nip');
        $this->db->order_by('pembelian_anggota.tanggal', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }

    function chekHutang($nip) {
        $query = $this->db->get_where('pembayaran_hutang', array('nip' => $nip), 1, 0);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function countPenjualan() {
        return $this->db->count_all($this->table_penjualan);
    }

    function countHutang() {
        return $this->db->count_all($this->table_penjualan);
    }

    /* for ajax function */

//dalam form penjualan
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

//dalam form pembayaran hutang
    function getFromNIPHutang($nip) {
        $this->db->select('user.nama,sum(pembayaran_hutang.saldo) as total');
        $this->db->from('pembayaran_hutang pembayaran_hutang,user user');
        $this->db->where('pembayaran_hutang.nip', $nip);
        $this->db->where('user.nip', $nip);
        return $this->db->get();
    }

}

?>