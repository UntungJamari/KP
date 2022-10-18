<?php

include "../koneksi/koneksi.php";
session_start();

if ($_SESSION['level'] != "kab/kota") {
    header("location:../");
}
