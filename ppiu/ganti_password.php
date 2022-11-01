<?php
include "session_ppiu.php";


if (isset($_POST['simpan'])) {

    if (empty($_POST["password_lama"]) || empty($_POST["password_baru"]) || empty($_POST["konfirmasi_password_baru"])) {
        $gagal = "Tidak Boleh Ada Isian yang Kosong!!";
    } else {
        $username = $_POST['username'];

        $password_lama = mysqli_real_escape_string($koneksi, $_POST["password_lama"]);

        $query = mysqli_query($koneksi, "select * from user WHERE username = '$username'");

        $result = mysqli_fetch_assoc($query);

        if (password_verify($password_lama, $result["password"])) {

            $password_baru = $_POST["password_baru"];
            $konfirmasi_password_baru = $_POST["konfirmasi_password_baru"];

            if (strlen($password_baru) >= 8) {

                if ($password_baru == $konfirmasi_password_baru) {
                    $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

                    $query = mysqli_query($koneksi, "update user set password='$password_baru' where username='$username';");

                    if ($query) {
                        $berhasil = "Password Berhasil Diubah!!";
                    } else {
                        $gagal = "Password Gagal Diubah!!";
                    }
                } else {
                    $gagal = "Konfirmasi Password Salah!!";
                }
            } else {
                $gagal = "Password baru harus minimal 8 karakter!";
            }
        } else {
            $gagal = "Password Lama Salah!!";
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

    <link rel="icon" type="image/png" href="../images/logo_kemenag.png">
    <title>Ganti Password</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../font/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link rel="stylesheet" type="text/css" href="../plugin/datatables/dataTables.bootstrap5.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "sidebar.html"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "header.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>

                                    <?php
                                    if (isset($gagal)) {
                                    ?>
                                        <script>
                                            swal.fire({
                                                icon: 'error',
                                                showConfirmButton: false,
                                                timer: '2000',
                                                title: '<?php echo $gagal; ?>'
                                            })
                                        </script>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (isset($berhasil)) {
                                    ?>
                                        <script>
                                            swal.fire({
                                                icon: 'success',
                                                showConfirmButton: false,
                                                timer: '2000',
                                                title: '<?php echo $berhasil; ?>'
                                            })
                                        </script>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <?php

                                    $username = $_SESSION['username'];
                                    $query = mysqli_query($koneksi, "select * from ppiu where username='$username'");
                                    $result = mysqli_fetch_assoc($query);

                                    ?>

                                    <form class="row g-2" action="ganti_password.php" method="POST">
                                        <input type="hidden" name="username" value="<?php echo $result['username']; ?>">
                                        <div class="col-md-12 form-group">
                                            <label for="input1" class="form-label">Password Lama</label>
                                            <input autofocus type="password" class="form-control" id="input1" name="password_lama" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="input2" class="form-label">Password Baru</label>
                                            <input autofocus type="password" class="form-control" id="input2" name="password_baru" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="input3" class="form-label">Konfirmasi Password Baru</label>
                                            <input autofocus type="password" class="form-control" id="input3" name="konfirmasi_password_baru" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <center>
                                                <button type="submit" class="btn btn-outline-primary btn-sm my-3" name="simpan">
                                                    <i class="fas fa-fw fa fa-save"></i>
                                                    <span>Simpan</span>
                                                </button>
                                            </center>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Kanwil Kemenag Sumbar 2022</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
</body>

</html>