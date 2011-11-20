<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//    fungsi tambahan
function status_bayar($value) {
    if ($value == 0) {
        return "Cash";
    } else {
        return "Hutang";
    }
}

function status_lunas($bayar, $value, $id) {
    if ($bayar == 0) {
        if ($value == 0) {
            return "Belum";
        } else {
            return "Lunas";
            ;
        }
    } else {
        if ($value == 0) {
            return anchor('retail/hutang_anggota/lunas/' .$value.'/'. $id, "Belum", array());
        } else {
            return anchor('retail/hutang_anggota/lunas/' .$value .'/'. $id, "Lunas", array());
            ;
        }
    }
}

//merubah ke format rupiah
function rupiah($jumlah) {
    if ($jumlah <> 0) {
        $jumlah = "Rp. " . number_format($jumlah, 2, ",", ".");
    } else {
        $jumlah = "-";
    }
    return "$jumlah";
}
?>
