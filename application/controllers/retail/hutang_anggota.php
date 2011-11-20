<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hutang_anggota
 *
 * @author haqisaurus
 */
class Hutang_anggota extends CI_Controller {

    //put your code here
    var $limit = 50;

    function __construct() {
        parent::__construct();
        $this->load->model('penjualan_model', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('login') == TRUE) {
            $this->getShowHutang();
        } else {
            redirect('login/login');
        }
    }

    function getShowHutang() {
        $data['menu'] = anchor('retail/hutang_anggota', "Penjualan", array());
        $data['link'] = anchor('retail/hutang_anggota', "Tambah Penjualan", array());
        $data['link1'] = anchor('retail/hutang_anggota', "Cari", array());
        $data['form_action'] = site_url('retail/hutang_anggota/deletePenjualanChecked/');
        $data['content'] = "retail/penjualan/list_hutang_view";
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        $datas = $this->penjualan_model->getAllHutang($this->limit, $offset)->result();
        $num_rows = $this->penjualan_model->countHutang();
        if ($num_rows > 0) {
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $tmpl = array('table_open' => '<table border="0" class="table_data">', 'row_alt_start' => '<tr class="zebra">');
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('<input type="checkbox" id="checkAll" value="check"/>', ' No ', ' Pembeli ', ' Nama ', ' Nama Barang ', ' Kode Barang ', 'Jumlah  ', ' Harga Jual  ', ' Tanggal ', 'Aksi');
            $i = 0 + $offset;
            $i = $i + 1;
            foreach ($datas as $row) {
                $cekbox = '<input type="checkbox" name="id[]" value="' . $row->kode_barang . '"/>';
                $this->table->add_row($cekbox, $i++, $row->nip, $row->nama, $row->nama_barang, $row->kode_barang, $row->jumlah, $row->harga_jual, $row->tanggal, anchor('retail/barang/updateBarang/' . $row->kode_barang, "Update ", array('class' => 'update', 'id' => 'edit')) . ' | ' . anchor('retail/barang/deleteBarang/' . $row->kode_barang, "Hapus ", array('class' => 'delete', 'id' => 'hapus', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
            }
            $data['table'] = $this->table->generate();
        } else {
            $data['message'] = 'Tidak ditemukan satupun data barang !!';
        }
        $this->load->view('home_view', $data);
    }

}

?>
