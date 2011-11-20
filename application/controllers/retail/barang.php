<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of barang
 *
 * @author haqisaurus
 */
class Barang extends CI_Controller {

    //put your code here
    var $limit = 50;

    function __construct() {
        parent :: __construct();
        $this->load->model('barang_model', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('login') == TRUE) {
            $this->getInputBarang();
        } else {
            redirect('login/login');
        }
    }

    function getInputBarang() {
        $data['menu'] = anchor('retail/barang', "Barang", array());
        $data['link'] = anchor('retail/barang/showListBarang', "Daftar Barang", array());
        //		jika dalam content kita mengarahkan ke input form berarti hanya ada 1 link
        $data['content'] = "retail/barang/input_barang_view";
        $data['form_action'] = site_url('retail/barang/inputProccess');
        $this->load->view('home_view', $data);
    }

    function inputProccess() {
        $data['menu'] = anchor('retail/barang', "Barang", array());
        $data['link'] = anchor('retail/barang/showListBarang', "Daftar Barang", array());
        $data['form_action'] = site_url('retail/barang/inputProccess');
        $data['content'] = "retail/barang/input_barang_view";
        $this->form_validation->set_rules('kodeBarang', 'KODE_BARANG', 'required');
        $this->form_validation->set_rules('namaBarang', 'NAMA_BARANG', 'required');
        $this->form_validation->set_rules('hargaBarang', 'HARGA_BARANG', 'required');
        if ($this->input->post('jenis') == 1) {
            $this->form_validation->set_rules('ppn', 'PPN_BARANG', 'required');
        }
        $this->form_validation->set_rules('jumlahBarang', 'JUMLAH_BARANG', 'required');
        $this->form_validation->set_rules('pemasokBarang', 'PEMASOK_BARANG', 'required');
        $this->form_validation->set_rules('tglMasukBarang', 'TANGGAL_MASUK', 'required');
        if ($this->form_validation->run() == TRUE) {
            if ($this->barang_model->cekKodeBarang($this->input->post('kodeBarang')) == TRUE) {
                $this->session->set_flashdata('message', 'Data tidak bisa disimpan terdapat duplikasi kode barang!');
                redirect('retail/barang');
            } else {
                $dataInput = array('kode_barang' => $this->input->post('kodeBarang'), 'nama_barang' => $this->input->post('namaBarang'), 'harga_beli' => $this->input->post('hargaBarang'), 'PPN' => $this->input->post('ppn'), 'jumlah' => $this->input->post('jumlahBarang'), 'pemasok' => $this->input->post('pemasokBarang'), 'tanggal_masuk' => $this->input->post('tglMasukBarang'));
                $this->barang_model->insertBarang($dataInput);
                $this->session->set_flashdata('message', 'Satu data barang berhasil disimpan!');
                redirect('retail/barang');
            }
        } else {
            $this->load->view('home_view', $data);
        }
    }

    function updateBarang($kode_barang) {
        $data['menu'] = anchor('retail/barang', "Barang", array());
        $data['link'] = anchor('retail/barang/showListBarang', "Daftar Barang", array());
        $data['form_action'] = site_url('retail/barang/updateProccess/' . $kode_barang);
        $data['content'] = 'retail/barang/input_barang_view';
        $datas = $this->barang_model->getDataUpdate($kode_barang)->row();
        $data['default']['kodeBarang'] = $datas->kode_barang;
        $data['default']['namaBarang'] = $datas->nama_barang;
        $data['default']['hargaBarang'] = $datas->harga_beli;
        if ($datas->PPN > 0) {
            $data['default']['jenis'] = 1;
        }
        $data['default']['ppn'] = $datas->PPN;
        $data['default']['jumlahBarang'] = $datas->jumlah;
        $data['default']['pemasokBarang'] = $datas->pemasok;
        $data['default']['tglMasukBarang'] = $datas->tanggal_masuk;
        $this->load->view('home_view', $data);
    }

    function updateProccess($kode_barang) {
        $data['menu'] = anchor('retail/barang', "Barang", array());
        $data['link'] = anchor('retail/barang', "Tambah Barang", array());
        $data['link1'] = anchor('retail/barang', "Cari", array());
        $data['form_action'] = site_url('retail/barang/deleteBarangChecked/');
        $data['content'] = 'retail/barang/list_barang_view';
        $this->form_validation->set_rules('kodeBarang', 'KODE_BARANG', 'required');
        $this->form_validation->set_rules('namaBarang', 'NAMA_BARANG', 'required');
        $this->form_validation->set_rules('hargaBarang', 'HARGA_BARANG', 'required');
        if ($this->input->post('jenis') == 1) {
            $this->form_validation->set_rules('ppn', 'PPN_BARANG', 'required');
        }
        $this->form_validation->set_rules('jumlahBarang', 'JUMLAH_BARANG', 'required');
        $this->form_validation->set_rules('pemasokBarang', 'PEMASOK_BARANG', 'required');
        $this->form_validation->set_rules('tglMasukBarang', 'TANGGAL_MASUK', 'required');
        if ($this->form_validation->run() == TRUE) {
            $dataUpdate = array('kode_barang' => $this->input->post('kodeBarang'), 'nama_barang' => $this->input->post('namaBarang'), 'harga_beli' => $this->input->post('hargaBarang'), 'PPN' => $this->input->post('ppn'), 'jumlah' => $this->input->post('jumlahBarang'), 'pemasok' => $this->input->post('pemasokBarang'), 'tanggal_masuk' => $this->input->post('tglMasukBarang'));
            $this->barang_model->updateBarang($kode_barang, $dataUpdate);
            $this->session->set_flashdata('message', 'Satu data aksesoris berhasil update!');
            redirect('retail/barang/showListBarang');
        } else {
            $this->load->view('home_view', $data);
        }
    }

    function deleteBarang($kode_barang) {
        $this->barang_model->deleteBarang($kode_barang);
        $this->session->set_flashdata('message', '1 data barang berhasil dihapus');
        redirect('retail/barang/showListBarang');
    }

    function deleteBarangChecked() {
        $this->form_validation->set_rules('id', 'KODE_BARANG', 'required');
        if ($this->form_validation->run() == TRUE) {
            $jumlah = count($this->input->post('id'));
            if ($jumlah > 0) {
                foreach ($this->input->post('id') as $kode_barang) {
                    $this->barang_model->deleteBarang($kode_barang);
                }
            }
            $this->session->set_flashdata('message', $jumlah . 'Data-data barang berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Anda belum memilih');
        }
        redirect('retail/barang/showListBarang');
    }

    function showListBarang() {
        $data['menu'] = anchor('retail/barang', "Barang", array());
        $data['link'] = anchor('retail/barang', "Tambah Barang", array());
        $data['link1'] = anchor('retail/barang', "Cari", array());
        $data['form_action'] = site_url('retail/barang/deleteBarangChecked/');
        $data['content'] = "retail/barang/list_barang_view";
        $uri_segment = 4;
        $offset = $this->uri->segment($uri_segment);
        $datas = $this->barang_model->getAllBarang($this->limit, $offset)->result();
        $num_rows = $this->barang_model->countBarang();
        if ($num_rows > 0) {
            $config['base_url'] = site_url('retail/barang/showListBarang');
            $config['total_rows'] = $num_rows;
            $config['per_page'] = $this->limit;
            $config['uri_segment'] = $uri_segment;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $tmpl = array('table_open' => '<table border="0" class="table_data">', 'row_alt_start' => '<tr class="zebra">');
            $this->table->set_template($tmpl);
            $this->table->set_empty("&nbsp;");
            $this->table->set_heading('<input type="checkbox" id="checkAll" value="check"/>', ' No ', ' Nama Barang ', ' Kode Barang ', ' Harga Beli ', ' Jumlah  ', ' Pemasok ', 'Tanggal Masuk', 'Aksi');
            $i = 0 + $offset;
            $i = $i + 1;
            foreach ($datas as $row) {
                $cekbox = '<input type="checkbox" name="id[]" value="' . $row->kode_barang . '"/>';
                $this->table->add_row($cekbox, $i++, $row->nama_barang, $row->kode_barang, $row->harga_beli, $row->jumlah, $row->pemasok, $row->tanggal_masuk, anchor('retail/barang/updateBarang/' . $row->kode_barang, "Update ", array('class' => 'update', 'id' => 'edit')) . ' | ' . anchor('retail/barang/deleteBarang/' . $row->kode_barang, "Hapus ", array('class' => 'delete', 'id' => 'hapus', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')")));
            }
            $data['table'] = $this->table->generate();
        } else {
            $data['message'] = 'Tidak ditemukan satupun data barang !!';
        }
        $this->load->view('home_view', $data);
    }

}

?>
