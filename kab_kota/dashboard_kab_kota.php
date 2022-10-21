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
                                    <a href="tambah_ppiu.php" type="button" class="btn btn-outline-info btn-sm mb-3">
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
                                                    <th style="width: 13%;">Tanggal SK</th>
                                                    <th>Alamat</th>
                                                    <th style="width: 14%;">Aksi</th>
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
                                                        <td>
                                                            <a id="detail" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-detail" data-id_ppiu="<?php echo $tampil['id_ppiu']; ?>" data-nama_ppiu="<?php echo $tampil['nama_ppiu']; ?>" data-nama_kab_kota="<?php echo $tampil['nama_kab_kota']; ?>" data-status="<?php echo $tampil['status']; ?>" data-nomor_sk="<?php echo $tampil['nomor_sk']; ?>" data-tanggal_sk="<?php echo $tampil['tanggal_sk']; ?>" data-alamat="<?php echo $tampil['alamat']; ?>" data-nama_pimpinan="<?php echo $tampil['nama_pimpinan']; ?>" data-logo="<?php echo $tampil['logo']; ?>">
                                                                <i class="fas fa-fw fa fa-eye"></i>
                                                            </a>
                                                            <a href="edit_ppiu.php?id_ppiu=<?php echo $tampil['id_ppiu'] ?>" type="button" class="btn btn-outline-warning btn-sm">
                                                                <i class="fas fa-fw fa fa-edit"></i>
                                                            </a>
                                                            <a href="dashboard_kab_kota.php?id_ppiu=<?php echo $tampil['id_ppiu'] ?>" type="button" class="btn btn-outline-danger btn-sm">
                                                                <i class="fas fa-fw fa fa-trash-alt"></i>
                                                            </a>
                                                        </td>
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
                    <div class="modal fade" id="modal-detail">
                        <div class="modal-dialog">
                            <div class="modal-content card shadow mb-4">
                                <div class="modal-header card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="modal-title m-0 font-weight-bold text-primary">Detail PPIU</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body table-responsive card-body">
                                    <center>
                                        <img class="mb-5" id="gambar" style="width: 300px;">
                                    </center>
                                    <table class="table table-bordered no-margin">
                                        <tbody>
                                            <tr>
                                                <th>ID PPIU</th>
                                                <td><span id="id_ppiu"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Nama PPIU</th>
                                                <td><span id="nama_ppiu"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Kab/Kota</th>
                                                <td><span id="nama_kab_kota"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><span id="status"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Nomor SK</th>
                                                <td><span id="nomor_sk"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal SK</th>
                                                <td><span id="tanggal_sk"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td><span id="alamat"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pimpinan</th>
                                                <td><span id="nama_pimpinan"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $(document).on('click', '#detail', function() {
                                var id_ppiu = $(this).data('id_ppiu');
                                var nama_ppiu = $(this).data('nama_ppiu');
                                var nama_kab_kota = $(this).data('nama_kab_kota');
                                var status = $(this).data('status');
                                var nomor_sk = $(this).data('nomor_sk');
                                var tanggal_sk = $(this).data('tanggal_sk');
                                var alamat = $(this).data('alamat');
                                var nama_pimpinan = $(this).data('nama_pimpinan');
                                var logo = $(this).data('logo');
                                $('#id_ppiu').text(id_ppiu);
                                $('#nama_ppiu').text(nama_ppiu);
                                $('#nama_kab_kota').text(nama_kab_kota);
                                $('#status').text(status);
                                $('#nomor_sk').text(nomor_sk);
                                $('#tanggal_sk').text(tanggal_sk);
                                $('#alamat').text(alamat);
                                $('#nama_pimpinan').text(nama_pimpinan);
                                $('#logo').text(logo);
                                $('#gambar').attr('src', '../images/profile/' + logo);

                            })
                        })
                    </script>
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