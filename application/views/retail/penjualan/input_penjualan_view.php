<script type="text/javascript" src="<?php echo base_url() . 'js/penjualan.js'; ?>"></script>
<?php
echo '<h1>Home -> ' . $menu . '</a></h1>';
//untuk link yang terdapat dalam form cukup 1 saja
echo '<div id="alternate_menu">' . $link . '</a></div>';
$flashmessage = $this->session->flashdata('message');
$attributes = array('name' => 'input_form', 'id' => 'input_form');
echo form_open($form_action, $attributes);
?>
<table class="table_form" judul="FORM INPUT PENJUALAN">
    <tr>
        <td>Kode Barang</td>
        <td><input type="text" name="kodeBarang" id="kodeBarang" value="<?php echo set_value('kodeBarang', isset($default['kodeBarang']) ? $default['kodeBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td><input type="text" name="namaBarang" id="namaBarang" value="<?php echo set_value('namaBarang', isset($default['namaBarang']) ? $default['namaBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Pembeli</td>
        <td>
            <select name="pembeli" id="pembeli" style="width:auto;" value="<?php echo set_value('pembeli', isset($default['pembeli']) ? $default['pembeli'] : ''); ?>">
                <option value="0">=: Jenis Pembeli :=</option>
                <option value="1">Anggota</option>
                <option value="2">Non Anggota</option>
            </select>
        </td>
    </tr>
    <tr id="bayarPengambil">
        <td>jenis Pembelian</td>
        <td>
            <select name="jenis" id="jenis" style="width:auto;" value="<?php echo set_value('jenis', isset($default['jenis']) ? $default['jenis'] : ''); ?>">
                <option value="0">Cash</option>
                <option value="1">Hutang</option>
            </select>
        </td>
    </tr>
    <tr id=nipPengambil>
        <td >NIP</td>
        <td><input type="text" name="nip" id="nip" value="<?php echo set_value('nip', isset($default['nip']) ? $default['nip'] : ''); ?>"/></td>
    </tr>
    <tr id=namaPengambil>
        <td >Nama</td>
        <td><input type="text" name="nama" id="nama" disabled style="border: none;background-color: white" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Harga Beli</td>
        <td><input type="text" name="hargaBeli" id="hargaBeli" disabled style="border: none;background-color: white" value="<?php echo set_value('hargaBeli', isset($default['hargaBeli']) ? $default['hargaBeli'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td >Harga Patokan</td>
        <td >
            <select name="profit" id="profit" style="width:auto;" value="<?php echo set_value('profit', isset($default['profit']) ? $default['profit'] : ''); ?>">
                <option value="0">1%</option>
                <option value="1">2%</option>
                <option value="2">3%</option>
                <option value="3">4%</option>
                <option value="4">5%</option>
                <option value="5">10%</option>
                <option value="6">15%</option>
                <option value="7">20%</option>
                <option value="8">25%</option>
                <option value="9">30%</option>
                <option value="10">35%</option>
                <option value="11">40%</option>
                <option value="12">45%</option>
            </select>
            <b>&nbsp;Rp.</b>
            <input type="text" name="hargaUntung" id="hargaUntung" disabled  style="border: none;background-color: white" value="<?php echo set_value('hargaUntung', isset($default['hargaUntung']) ? $default['hargaUntung'] : ''); ?>"/>
        </td>
    </tr>
    <tr>
        <td>Harga Terjual</td>
        <td><input type="text" name="hargaJual" id="hargaJual" value="<?php echo set_value('hargaJual', isset($default['hargaJual']) ? $default['hargaJual'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Jumlah Barang</td>
        <td><input type="text" name="jumlahBarang" id="jumlahBarang" style="width:100px;" value="<?php echo set_value('jumlahBarang', isset($default['jumlahBarang']) ? $default['jumlahBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Tanggal Terjual</td>
        <td><input type="text" name="tanggalTerjual" id="tanggalTerjual" style="width:100px;" readonly value="<?php echo set_value('tanggalTerjual', isset($default['tanggalTerjual']) ? $default['tanggalTerjual'] : ''); ?>"/></td>
    </tr>

</table>
<input type="submit" value="submit" class="button_blue" />
<?php
echo "</form>";
echo!empty($message) ? '<script type="text/javascript">alert("' . $message . '")</script>' : '';
echo!empty($flashmessage) ? '<script type="text/javascript">alert("' . $flashmessage . '")</script>' : '';
?>
