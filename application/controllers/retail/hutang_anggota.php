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
        $this->load->helper('tambahan');
    }

    function index() {
        if ($this->session->userdata('login') == TRUE) {
            $this->getShowHutang();
        } else {
            redirect('login/login');
        }
    }

    function inputProccess() {
        $data['menu'] = anchor('retail/hutang_anggota', "Daftar Hutang Anggota", array());
        $data['link'] = anchor('retail/hutang_anggota/showListBarang', "Daftar Barang", array());
        $data['form_action'] = site_url('retail/hutang_anggota/inputProccess');
        $data['content'] = "retail/hutang_anggota/input_hutang_view";
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('tanggal', 'TANGGAL_PEMBAYARAN', 'required');
        $this->form_validation->set_rules('bayar', 'BAYAR', 'required');
        if ($this->form_validation->run() == TRUE) {
                $dataInputPembayaran = array(
                    'nip' => $this->input->post('nip'),
                    'tanggal_bayar' => $this->input->post('tanggal'),
                    'saldo' => '-'.$this->input->post('bayar'));
                $this->penjualan_model->insertHutang($dataInputPembayaran);
                $this->session->set_flashdata('message', 'Berhasil melakukan pembayaran !');
                redirect('retail/barang');
        } else {
            $this->load->view('home_view', $data);
        }
    }

    function getShowHutang() {
        $data['menu'] = anchor('retail/hutang_anggota', "Daftar Hutang Anggota", array());
        $data['link'] = anchor('retail/hutang_anggota/getFormPembayaran', "Pembayaran hutang", array());
        $data['link1'] = anchor('retail/hutang_anggota', "Cari", array());
        $data['form_action'] = site_url('retail/hutang_anggota/deletePenjualanChecked/');
        $data['content'] = "retail/hutang/list_hutang_view";
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
            $this->table->set_heading('<input type="checkbox" id="checkAll" value="check"/>', ' No ', ' Pembeli ', ' Nama ', ' Nama Barang ', ' Kode Barang ', 'Jumlah  ', ' Harga Jual  ', ' Bayar  ', ' Lunas  ', ' Tanggal ', 'Aksi');
            $i = 0 + $offset;
            $i = $i + 1;
            foreach ($datas as $row) {
                $cekbox = '<input type="checkbox" name="id[]" value="' . $row->kode_barang . '"/>';
                $this->table->add_row(
                        $cekbox,
                        $i++,
                        $row->nip,
                        $row->nama,
                        $row->nama_barang,
                        $row->kode_barang,
                        $row->jumlah,
                        rupiah($row->harga_jual),
                        status_bayar($row->status_bayar),
                        status_lunas($row->status_bayar, $row->status_lunas, $row->hutang_id),
                        $row->tanggal,
                        anchor('retail/barang/updateBarang/' . $row->kode_barang, "Update ", array('class' => 'update', 'id' => 'edit')) . ' | ' . anchor('retail/barang/deleteBarang/' . $row->kode_barang, "Hapus ", array('class' => 'delete', 'id' => 'hapus', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
            }
            $data['table'] = $this->table->generate();
        } else {
            $data['message'] = 'Tidak ditemukan satupun data barang !!';
        }
        $this->load->view('home_view', $data);
    }

    function getFormPembayaran() {
        $data['menu'] = anchor('retail/hutang_anggota', "Daftar Hutang Anggota", array());
        $data['link'] = anchor('retail/hutang_anggota/', "Daftar Penjualan", array());
        $data['content'] = "retail/hutang/input_pembayaran_view";
        $data['form_action'] = site_url('retail/hutang_anggota/inputProccess');
        $this->load->view('home_view', $data);
    }
    
    function lunas($status,$hutang_id){
        if($status==0){
            $dataUpdate=array('status_lunas' => 1);
        }else{
            $dataUpdate=array('status_lunas' => 0);
        }
        $this->penjualan_model->updateStatusLunas($dataUpdate,$hutang_id);
        $this->getShowHutang();
    }


//    function for ajax

    //    fungsi autocomplete dari nip
    function autoComFromNIP() {
        $keyword = trim($this->input->get('term'));
        if ($this->penjualan_model->getFromNIP($keyword)->num_rows() > 0) {
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();

            foreach ($this->penjualan_model->getFromNIP($keyword)->result() as $row) {
                $data['message'][] = array(
                    'label' => $row->nip,
                    'item' => $row->nip,
                    'value' => $row->nip
                );
            }
        } else {
            $data['response'] = 'false'; //Set false if user not valid
        }
        echo json_encode($data);
    }

    function getFromNIP($keyword) {
//        $keyword = trim($this->input->post('nip'));
        if ($this->penjualan_model->getFromNIPHutang($keyword)->num_rows() > 0) {
            echo json_encode($this->penjualan_model->getFromNIPHutang($keyword)->result());
        }
    }

}

?>
