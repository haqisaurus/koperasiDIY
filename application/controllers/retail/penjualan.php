<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of penjualan
 *
 * @author haqisaurus
 */
class Penjualan extends CI_Controller {

    //put your code here
    var $limit = 50;

    function __construct() {
        parent::__construct();
        $this->load->model('penjualan_model', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('login') == TRUE) {
            $this->getInputPenjualan();
        } else {
            redirect('login/login');
        }
    }

    function getInputPenjualan() {
        $data['menu'] = anchor('retail/penjualan', "Penjualan", array());
        $data['link'] = anchor('retail/penjualan/showListPenjualan', "Daftar Penjualan", array());
        //jika dalam content kita mengarahkan ke input form berarti hanya ada 1 link
        $data['content'] = "retail/penjualan/input_penjualan_view";
        $data['form_action'] = site_url('retail/penjualan/inputProccess');
        $this->load->view('home_view', $data);
    }

    function inputProccess() {
        $data['menu'] = anchor('retail/penjualan', "Penjualan", array());
        $data['link'] = anchor('retail/penjualan/showListPenualan', "Daftar Penjualan", array());
        $data['form_action'] = site_url('retail/penjualan/inputProccess');
        $data['content'] = "retail/barang/input_penjualan_view";

        $this->form_validation->set_rules('kodeBarang', 'KODE_BARANG', 'required');
        $this->form_validation->set_rules('jenis', 'JENIS_PEMBELIAN', 'required');
        if ($this->input->post('pembeli') == 1) {
            $this->form_validation->set_rules('nip', 'NIP', 'required');
        }
        $this->form_validation->set_rules('hargaJual', 'HARGA_JUAL', 'required');
        $this->form_validation->set_rules('jumlahBarang', 'JUMLAH_BARANG', 'required');
        $this->form_validation->set_rules('tanggalTerjual', 'TANGGAL_TERJUAL', 'required');
        if ($this->form_validation->run() == TRUE) {
            if ($this->penjualan_model->getFromKode($this->input->post('kodeBarang'))->num_rows() > 0) {
//            penjualan kepada anggota bpd (pembeli =1)
                if ($this->input->post('pembeli') == 1) {
                    $dataInput = array(
                        'harga_jual' => $this->input->post('hargaJual'),
                        'tanggal' => $this->input->post('tanggalTerjual'),
                        'jumlah' => $this->input->post('jumlahBarang'),
                        'status_bayar' => $this->input->post('jenis'),
                        'nip' => $this->input->post('nip'),
                        'kode_barang' => $this->input->post('kodeBarang'));
                    $this->penjualan_model->insertPenjualanAnggota($dataInput);
                    $this->penjualan_model->updateBarangTerjual($this->input->post('kodeBarang'), $this->input->post('jumlahBarang'));
                } else {
                    $dataInput = array(
                        'harga_jual' => $this->input->post('hargaJual'),
                        'tanggal' => $this->input->post('tanggalTerjual'),
                        'jumlah' => $this->input->post('jumlahBarang'),
                        'kode_barang' => $this->input->post('kodeBarang'));
                    $this->penjualan_model->insertPenjualanUmum($dataInput);
                    $this->penjualan_model->updateBarangTerjual($this->input->post('kodeBarang'), $this->input->post('jumlahBarang'));
                }
                $this->session->set_flashdata('message', 'Satu data barang berhasil disimpan!');
                redirect('retail/penjualan');
            } else {
                $this->session->set_flashdata('message', 'Stok Barang sudah habis!');
                redirect('retail/penjualan');
            }
        } else {
            $this->load->view('home_view', $data);
        }
    }

    function showListPenjualan() {
        $data['menu'] = anchor('retail/penjualan', "Penjualan", array());
        $data['link'] = anchor('retail/penjualan', "Tambah Penjualan", array());
        $data['link1'] = anchor('retail/penjualan', "Cari", array());
        $data['form_action'] = site_url('retail/penjualan/deletePenjualanChecked/');
        $data['content'] = "retail/penjualan/list_penjualan_view";
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        $datas = $this->penjualan_model->getAllPenjualan($this->limit, $offset)->result();
        $num_rows = $this->penjualan_model->countPenjualan();
        if ($num_rows > 0) {
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $tmpl = array('table_open' => '<table border="0" class="table_data">', 'row_alt_start' => '<tr class="zebra">');
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('<input type="checkbox" id="checkAll" value="check"/>', ' No ', ' Nama Barang ', ' Kode Barang ', 'Jumlah  ', ' Harga Jual  ', ' Tanggal ', 'Aksi');
            $i = 0 + $offset;
            $i = $i + 1;
            foreach ($datas as $row) {
                $cekbox = '<input type="checkbox" name="id[]" value="' . $row->kode_barang . '"/>';
                $this->table->add_row($cekbox, $i++, $row->nama_barang, $row->kode_barang, $row->jumlah, $row->harga_jual, $row->tanggal, anchor('retail/barang/updateBarang/' . $row->kode_barang, "Update ", array('class' => 'update', 'id' => 'edit')) . ' | ' . anchor('retail/barang/deleteBarang/' . $row->kode_barang, "Hapus ", array('class' => 'delete', 'id' => 'hapus', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
            }
            $data['table'] = $this->table->generate();
        } else {
            $data['message'] = 'Tidak ditemukan satupun data barang !!';
        }
        $this->load->view('home_view', $data);
    }

    /* ajax function */

//    fungsi autocomplete dari kode
    function autoComFromKode() {
        $keyword = trim($this->input->get('term'));
        if ($this->penjualan_model->getFromKode($keyword)->num_rows() > 0) {
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();

            foreach ($this->penjualan_model->getFromKode($keyword)->result() as $row) {
                $data['message'][] = array(
                    'label' => $row->kode_barang,
                    'item' => $row->kode_barang,
                    'value' => $row->kode_barang
                );
            }
        } else {
            $data['response'] = 'false'; //Set false if user not valid
        }
        echo json_encode($data);
    }

    function getFromKode($keyword) {
        $keyword = $this->uri->segment(4);
//        $keyword = trim($this->input->post('term'));
        if ($this->penjualan_model->getFromKode($keyword)->num_rows() > 0) {
            echo json_encode($this->penjualan_model->getFromKode($keyword)->result());
        }
    }

//    fungsi autocomplete dari nama
    function autoComFromNama() {
        $keyword = trim($this->input->get('term'));
        if ($this->penjualan_model->getFromNama($keyword)->num_rows() > 0) {
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();

            foreach ($this->penjualan_model->getFromNama($keyword)->result() as $row) {
                $data['message'][] = array(
                    'label' => $row->nama_barang,
                    'item' => $row->nama_barang,
                    'value' => $row->nama_barang
                );
            }
        } else {
            $data['response'] = 'false'; //Set false if user not valid
        }
        echo json_encode($data);
    }

    function getFromNama() {
//        $keyword = $this->uri->segment(4);
        $keyword = trim($this->input->post('nama'));
        if ($this->penjualan_model->getFromNama($keyword)->num_rows() > 0) {
            echo json_encode($this->penjualan_model->getFromNama($keyword)->result());
        }
    }

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

    function getFromNIP() {
//        $keyword = $this->uri->segment(4);
        $keyword = trim($this->input->post('nip'));
        if ($this->penjualan_model->getFromNIP($keyword)->num_rows() > 0) {
            echo json_encode($this->penjualan_model->getFromNIP($keyword)->result());
        }
    }

}

?>
