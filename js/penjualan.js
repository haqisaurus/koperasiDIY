$(document).ready(function(){
    $('#tanggalTerjual').datepicker({
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
        }else if($("#pembeli").val()==1){
            if($("#nip").val()==""){
                alert("NIP harus diisi");
                $("#nip").focus();
                return false;
            }
        }else if($("#pembeli").val()==0){
                alert("Jenis Pembeli belum ditentukan");
                $("#pembeli").focus();
                return false;
        }else if($("#hargaBeli").val()==""){
            alert("Jumlah barang  harus diisi");
            $("#hargaBeli").focus();
            return false;
        }else if($("#hargaJual").val()==""){
            alert("Pemasok barang  harus diisi");
            $("#hargaJual").focus();
            return false;
        }else if($("#jumlahBarang").val()==""){
            alert("Tanggal Belanja barang  harus diisi");
            $("#jumlahBarang").focus();
            return false;
        }else if($("#jumlahBarang").val()==""){
            alert("Tanggal Belanja barang  harus diisi");
            $("#jumlahBarang").focus();
            return false;
        }else if($("#hargaJual").val()<=$("#hargaUntung").val()){
            alert("Harga terjual tidak memungkinkan !");
            $("#hargaJual").focus();
            return false;
        }else if($("#jumlahTerjual").val()<=0){
            alert("Jumlah terjual tidak boleh 0 !");
            $("#jumlahTerjual").focus();
            return false;
        }
    });
    //        cek pembeli
    if($('#pembeli').val()==1){
        $("#bayarPengambil").show();
        $("#nipPengambil").show();
        $("#namaPengambil").show();
        $('#namaPengambil').val()='';
    }else{
        $("#bayarPengambil").hide();
        $("#nipPengambil").hide();
        $("#namaPengambil").hide();
    }

    $("#pembeli").change(function(){
        if($('#pembeli').val()==1){
            $("#bayarPengambil").show();
            $("#nipPengambil").show();
            $("#namaPengambil").show();
            $('#namaPengambil').val()='';
        }else{
            $("#bayarPengambil").hide();
            $("#nipPengambil").hide();
            $("#namaPengambil").hide();
        }
    });

    $("#profit").mousemove(function(){
        if($('#profit').val()==0){
            $("#hargaUntung").val(($('#hargaBeli').val()*1/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==1){
            $("#hargaUntung").val(($('#hargaBeli').val()*2/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==2){
            $("#hargaUntung").val(($('#hargaBeli').val()*3/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==3){
            $("#hargaUntung").val(($('#hargaBeli').val()*4/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==4){
            $("#hargaUntung").val(($('#hargaBeli').val()*5/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==5){
            $("#hargaUntung").val(($('#hargaBeli').val()*10/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==6){
            $("#hargaUntung").val(($('#hargaBeli').val()*15/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==7){
            $("#hargaUntung").val(($('#hargaBeli').val()*20/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==8){
            $("#hargaUntung").val(($('#hargaBeli').val()*25/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==9){
            $("#hargaUntung").val(($('#hargaBeli').val()*30/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==10){
            $("#hargaUntung").val(($('#hargaBeli').val()*35/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==11){
            $("#hargaUntung").val(($('#hargaBeli').val()*40/100)+($('#hargaBeli').val()*1));
        }else if($('#profit').val()==12){
            $("#hargaUntung").val(($('#hargaBeli').val()*45/100)+($('#hargaBeli').val()*1));
        }
    });
//auto complete from kode
    $("#kodeBarang" ).autocomplete({
        source: function( req, add ) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/penjualan/autoComFromKode' ,
                dataType: 'json',
                type: 'POST',
                data: req,
                success: function(data){
                    if(data.response == 'true') {
                        add(data.message);
                    }
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/penjualan/getFromKode/'+ui.item.value ,
                dataType: "json",
                type: 'POST',
                success: function(data){
                    $('#namaBarang').val(data[0].nama_barang);
                    $('#hargaBeli').val(data[0].harga_beli);
                }
            });
        }
    });

    //auto complete from nama
    $("#namaBarang" ).autocomplete({
        source: function( req, add ) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/penjualan/autoComFromNama' ,
                dataType: 'json',
                type: 'POST',
                data: req,
                success: function(data){
                    if(data.response == 'true') {
                        add(data.message);
                    }
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/penjualan/getFromNama/' ,
                dataType: "json",
                type: 'POST',
                data: 'nama='+ui.item.value,
                success: function(data){
                    $('#kodeBarang').val(data[0].kode_barang);
                    $('#hargaBeli').val(data[0].harga_beli);
                }
            });
        }
    });

    //auto complete from nip
    $("#nip" ).autocomplete({
        source: function( req, add ) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/penjualan/autoComFromNIP/' ,
                dataType: 'json',
                type: 'POST',
                data: req,
                success: function(data){
                    if(data.response == 'true') {
                        add(data.message);
                    }
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/penjualan/getFromNIP' ,
                dataType: "json",
                type: 'POST',
                data: 'nip='+ui.item.value,
                success: function(data){
                    $('#nama').val(data[0].nama);
                }
            });
        }
    });
});

