<?php

include "../koneksi/koneksi.php";
session_start();

if ($_SESSION['level'] != "kanwil") {
    if ($_SESSION['level'] == "kab/kota") {
        header("location:../kab_kota/dashboard_kab_kota.php");
    } else if ($_SESSION['level'] == "ppiu") {
        header("location:../ppiu/dashboard_ppiu.php");
    } elseif (empty($_SESSION['level'])) {
        header("location:../otentikasi/login.php?user=Kosong");
    }
}
