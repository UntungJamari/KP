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
    <title>Dashboard</title>

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

        <?php include "admin_sidebar.html"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "header.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">PPIU</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar PPIU</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <a href="tambah_ppiu.php" type="button" class="btn btn-outline-info mb-3">
                                        <i class="fas fa-fw fa fa-plus"></i>
                                        <span>Tambah PPIU</span>
                                    </a>
                                    <div class="table-responsive">
                                        <?php

                                        $username = $_SESSION['username'];
                                        $query = mysqli_query($koneksi, "select * from kemenag_kab_kota, kab_kota, ppiu where kemenag_kab_kota.id_kab_kota=kab_kota.id_kab_kota and kab_kota.id_kab_kota=ppiu.id_kab_kota and kemenag_kab_kota.username='$username'");
                                        $no = 1;

                                        ?>
                                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px">No.</th>
                                                    <th>Nama PPIU</th>
                                                    <th>Status</th>
                                                    <th>No. SK</th>
                                                    <th style="width: 15%;">Tanggal SK</th>
                                                    <th>Alamat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                while ($tampil = mysqli_fetch_array($query)) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $tampil['nama_ppiu']; ?></td>
                                                        <td><?php echo $tampil['status']; ?></td>
                                                        <td><?php echo $tampil['nomor_sk']; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($tampil['tanggal_sk'])); ?></td>
                                                        <td><?php echo $tampil['alamat']; ?></td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

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