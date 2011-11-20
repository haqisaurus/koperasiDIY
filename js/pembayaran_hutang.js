/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$().ready(function(){
    $('#tanggal').datepicker({
        inline: true,
        dateFormat : "yy-mm-dd"
    });
    //auto complete from nip
    $("#nip" ).autocomplete({
        source: function( req, add ) {
            $.ajax({
                url:'http://localhost/koperasiBPD/index.php/retail/hutang_anggota/autoComFromNIP/' ,
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
                url:'http://localhost/koperasiBPD/index.php/retail/hutang_anggota/getFromNIP/'+ui.item.value ,
                dataType: "json",
                type: 'GET',
                data: 'nip='+ui.item.value,
                success: function(data){
                    $('#nama').val(data[0].nama);
                    $('#total').val(data[0].total);
                }
            });
        }
    });
});

