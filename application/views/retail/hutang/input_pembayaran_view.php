<script type="text/javascript" src="<?php echo base_url() . 'js/pembayaran_hutang.js'; ?>"></script>
<?php
echo '<h1>Home -> ' . $menu . '</a></h1>';
//untuk link yang terdapat dalam form cukup 1 saja
echo '<div id="alternate_menu">' . $link . '</a></div>';
$flashmessage = $this->session->flashdata('message');
$attributes = array('name' => 'input_form', 'id' => 'input_form');
echo form_open($form_action, $attributes);
?>
<table class="table_form" judul="FORM PEMBAYARAN">
    <tr>
        <td>NIP</td>
        <td><input type="text" name="nip" id="nip" value="<?php echo set_value('nip', isset($default['nip']) ? $default['nip'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" id="nama" disabled  style="border: none;background-color: white" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Total Hutang</td>
        <td><input type="text" name="total" id="total" disabled  style="border: none;background-color: white" value="<?php echo set_value('total', isset($default['total']) ? $default['total'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td><input type="text" name="tanggal" id="tanggal" style="width:100px;" readonly value="<?php echo set_value('tanggal', isset($default['tanggal']) ? $default['tanggal'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Pembayaran</td>
        <td><input type="text" name="bayar" id="bayar" value="<?php echo set_value('bayar', isset($default['bayar']) ? $default['bayar'] : ''); ?>"/></td>
    </tr>
</table>
<input type="submit" value="submit" class="button_blue" />
<?php
echo "</form>";
echo!empty($message) ? '<script type="text/javascript">alert("' . $message . '")</script>' : '';
echo!empty($flashmessage) ? '<script type="text/javascript">alert("' . $flashmessage . '")</script>' : '';
?>
