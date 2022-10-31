<?php

include "../koneksi/koneksi.php";
session_start();

if ($_SESSION['level'] != "ppiu") {
    if ($_SESSION['level'] == "kanwil") {
        header("location:../kanwil/dashboard_kanwil.php");
    } else if ($_SESSION['level'] == "Kab/kota") {
        header("location:../Kab_kota/dashboard_kab_kota.php");
    } elseif (empty($_SESSION['level'])) {
        header("location:../otentikasi/login.php?user=Kosong");
    }
}
