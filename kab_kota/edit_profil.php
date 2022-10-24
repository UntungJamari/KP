<?php
include "session_kab_kota.php";
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
    <title>Edit Profil</title>

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
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                                </div>
                                <div class="table-responsive card-body">
                                    <?php

                                    $username = $_SESSION['username'];
                                    $query = mysqli_query($koneksi, "select * from kemenag_kab_kota, kab_kota where kemenag_kab_kota.id_kab_kota=kab_kota.id_kab_kota and kemenag_kab_kota.username='$username'");
                                    $result = mysqli_fetch_assoc($query);

                                    ?>
                                    <center>
                                        <img src="../images/<?php echo $result['logo']; ?>" style="width: 250px;" class="mb-5">
                                    </center>
                                    <form class="row g-2 needs-validation" novalidate method="post">
                                        <div>
                                            <input type="hidden" class="form-control" style="background-color: #dee2e6" id="validationCustom01" pattern="^[A-Za-z]+([\A-Za-z]+)*" name="id_pelanggan" value="<?php echo $result['id_kemenag_kab_kota']; ?>" readonly required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validationCustom01" class="form-label">ID</label>
                                            <input type="text" class="form-control" style="background-color: #dee2e6" id="validationCustom01" name="nama_pelanggan" value="<?php echo $result['id_kemenag_kab_kota']; ?>" readonly disabled required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validationCustom02" class="form-label">Username</label>
                                            <input type="text" class="form-control" style="background-color: #dee2e6" id="validationCustom02" name="nama_pelanggan" value="<?php echo $result['username']; ?>" readonly disabled required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom03" class="form-label">Nama Pimpinan</label>
                                            <input autofocus type="text" class="form-control" id="validationCustom03" name="nama_pelanggan" value="<?php echo $result['nama_pimpinan']; ?>" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom04" class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="validationCustom04" cols="30" rows="3"><?php echo $result['alamat']; ?></textarea>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <center>
                                                <button href="edit_profil.php" type="submit" class="btn btn-outline-primary btn-sm my-3">
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

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>

</body>

</html>