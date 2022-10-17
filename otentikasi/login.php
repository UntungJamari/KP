<?php

session_start();
include "../koneksi/koneksi.php";

if (isset($_POST['submit'])) {

    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $gagal = "Username dan Password tidak boleh kosong!!";
    } else {

        $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
        $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

        $query = mysqli_query($koneksi, "select * from user WHERE username = '$username'");
        if (mysqli_affected_rows($koneksi) == 0) {
            $gagal = "Username Tidak Ditemukan";
        } else {
            $result = mysqli_fetch_assoc($query);

            if (password_verify($password, $result["password"])) {
                if ($result['level'] == "kanwil") {
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = $result['level'];
                    header("location:../kanwil/dashboard_kanwil.php");
                } else if ($result['level'] == "kab/kota") {
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = $result['level'];
                    header("location:../kab_kota/dashboard_kab_kota.php");
                } else {
                    $gagal = "Anda Harus Log In Terlebih Dahulu";
                }
            } else {
                $gagal = "Password Salah";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../font/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="../plugin/sweetalert2/sweetalert2.min.css">
    <script src="../plugin/sweetalert2/sweetalert2.min.js"></script>

</head>

<body class="background">
    <style type="text/css">
        .background {
            background: linear-gradient(#5cf25c, #076b07);
        }
    </style>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-4 col-md-5">
                <div class="card o-hidden border-0 shadow-lg mt-5">
                    <div class="card-body p-1">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                <form class="user" method="post" action="">
                                    <div class="text-center">
                                        <img src="../images/logo_kemenag.png" alt="logo_kemenag.png" width="30%">
                                    </div>
                                    <div class="text-center mt-5">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang di Sistem Informasi Pengawasan Umrah Sumatera Barat</h1>
                                        <?php
                                        if (isset($gagal)) {
                                        ?>
                                            <script>
                                                swal.fire({
                                                    icon: 'error',
                                                    showConfirmButton: false,
                                                    timer: '1500',
                                                    title: '<?php echo $gagal; ?>'
                                                })
                                            </script>
                                        <?php
                                        }
                                        if (isset($_GET['pesan'])) {
                                        ?>
                                            <p class="text-info pull-middle"><?php echo "Silakan Log In Terlebih Dahulu!"; ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group mt-5">
                                        <input type="username" name="username" class="form-control form-control-user" placeholder="Masukkan Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password">
                                    </div>
                                    <button class="btn btn-success btn-user btn-block" id="btn-login" name="submit" type="submit">
                                        Login
                                    </button>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>