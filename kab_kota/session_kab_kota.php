<?php

include "../koneksi/koneksi.php";
session_start();

if ($_SESSION['level'] != "kab/kota") {
    if ($_SESSION['level'] == "kanwil") {
        header("location:../kanwil/dashboard_kanwil.php");
    } else if ($_SESSION['level'] == "ppiu") {
        header("location:../ppiu/dashboard_ppiu.php");
    } elseif (empty($_SESSION['level'])) {
        header("location:../otentikasi/login.php?user=Kosong");
    }
}
