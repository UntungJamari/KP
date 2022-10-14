<?php

include "koneksi/koneksi.php";
$password = "12345678";
$password = password_hash($password, PASSWORD_DEFAULT);
$query = mysqli_query($koneksi, "insert into user values ('kemenag_pyk','$password', 'kab/kota')");
