<script type="text/javascript">
    $(document).ready(function(){
        $('#tglMasukBarang').datepicker({
            inline: true,
            dateFormat : "yy-mm-dd"
        });
        $('#input_form').submit(function(){
            if($("#kodeBarang").val()==""){
                alert("Kode barang harus disi");
                $("#kodeBarang").focus();
                return false;
            }else if($("#namaBarang").val()==""){
                alert("Nama barang  harus diisi");
                $("#namaBarang").focus();
                return false;
            }else if($("#hargaBarang").val()==""){
                alert("Harga barang  harus diisi");
                $("#hargaBarang").focus();
                return false;
            }else if($("#jumlahBarang").val()==""){
                alert("Jumlah barang  harus diisi");
                $("#jumlahBarang").focus();
                return false;
            }else if($("#pemasokBarang").val()==""){
                alert("Pemasok barang  harus diisi");
                $("#pemasokBarang").focus();
                return false;
            }else if($("#tglMasukBarang").val()==""){
                alert("Tanggal Belanja barang  harus diisi");
                $("#tglMasukBarang").focus();
                return false;
            }else if($("#jenis").val()==1){
                if($("#ppn").val()==""){
                    alert("PPN barang  harus diisi");
                    $("#ppn").focus();
                    return false;
                }
            }
        });
        if($('#jenis').val()==0){
            $("#ppnField").hide();
            $('#ppn').val()=0;
        }else{
            $("#ppnField").show();
            $("#hargaBarang").mousemove(function(){
                $('#ppn').val(Math.round(10/110*$("#hargaBarang").val()));
            });
        }
        $("#jenis").change(function(){
            if($('#jenis').val()==0){
                $("#ppnField").hide();
                $('#ppn').val()=0;
            }else{
                $("#ppnField").show();
                $("#hargaBarang").mousemove(function(){
                    $('#ppn').val(Math.round(10/110*$("#hargaBarang").val()));
                });
            }
        });
    });
</script>
<?php
echo '<h1>Home -> ' . $menu . '</a></h1>';
//untuk link yang terdapat dalam form cukup 1 saja
echo '<div id="alternate_menu">' . $link . '</a></div>';
$flashmessage = $this->session->flashdata('message');
$attributes = array('name' => 'input_form', 'id' => 'input_form');
echo form_open($form_action, $attributes);
?>
<table class="table_form" judul="FORM INPUT BARANG">
    <tr>
        <td>Kode Barang</td>
        <td><input type="text" name="kodeBarang" id="kodeBarang" value="<?php echo set_value('kodeBarang', isset($default['kodeBarang']) ? $default['kodeBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td><input type="text" name="namaBarang" id="namaBarang" value="<?php echo set_value('namaBarang', isset($default['namaBarang']) ? $default['namaBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Harga Beli</td>
        <td><input type="text" name="hargaBarang" id="hargaBarang" value="<?php echo set_value('hargaBarang', isset($default['hargaBarang']) ? $default['hargaBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Jenis</td>
        <td>
            <select name="jenis" id="jenis" style="width:auto;" value="<?php echo set_value('jenis', isset($default['jenis']) ? $default['jenis'] : ''); ?>">
                <option value="0">Non PPN</option>
                <option value="1">PPN</option>
            </select>
        </td>
    </tr>
    <tr id='ppnField' >
        <td>PPN</td>
        <td><input type="text" name="ppn" id="ppn" value="<?php echo set_value('ppn', isset($default['ppn']) ? $default['ppn'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td><input type="text" name="jumlahBarang" id="jumlahBarang" value="<?php echo set_value('jumlahBarang', isset($default['jumlahBarang']) ? $default['jumlahBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Pemasok</td>
        <td><input type="text" name="pemasokBarang" id="pemasokBarang" value="<?php echo set_value('pemasokBarang', isset($default['pemasokBarang']) ? $default['pemasokBarang'] : ''); ?>"/></td>
    </tr>
    <tr>
        <td>Tanggal Masuk</td>
        <td><input type="text" name="tglMasukBarang" id="tglMasukBarang" style="width:100px;" readonly value="<?php echo set_value('tglMasukBarang', isset($default['tglMasukBarang']) ? $default['tglMasukBarang'] : ''); ?>"/></td>
    </tr>

</table>
<input type="submit" value="submit" class="button_blue" />
<?php
echo "</form>";
echo!empty($message) ? '<script type="text/javascript">alert("'.$message.'")</script>' : '';
echo!empty($flashmessage) ? '<script type="text/javascript">alert("'.$flashmessage.'")</script>' : '';
?>
