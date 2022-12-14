<?php
include "session_kab_kota.php";

if ((isset($_GET['hapus_pengawasan'])) && (isset($_GET['id_pengawasan']))) {
    $id_pengawasan = $_GET['id_pengawasan'];

    $query = mysqli_query($koneksi, "select * from pengawasan where id_pengawasan='$id_pengawasan'");
    if (mysqli_affected_rows($koneksi) == 0) {
        $gagal = "Data yang Ingin Dihapus Sudah Tidak Ada!";
    } else {
        $query = mysqli_query($koneksi, "delete from pengawasan where id_pengawasan='$id_pengawasan'");

        if ($query) {
            $berhasil = "Berhasil Menghapus Data!";
        } else {
            $gagal = "Gagal Menghapus Data!";
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
    <title>Pengawasan Umrah</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Pengawasan Umrah</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengisian Blanko Pengawasan Umrah</h6>
                                    <a href="export.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export ke Excel</a>
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
                                    <?php
                                    if (isset($_GET['edit_id_pengawasan'])) {
                                    ?>
                                        <script>
                                            swal.fire({
                                                icon: 'info',
                                                showConfirmButton: false,
                                                timer: '2000',
                                                title: 'Silakan Pilih Terlebih Dahulu Data yang Ingin Diedit!'
                                            })
                                        </script>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php

                                        $id_kab_kota = $result['id_kab_kota'];
                                        $query = mysqli_query($koneksi, "select * from pengawasan, ppiu where pengawasan.id_ppiu=ppiu.id_ppiu and ppiu.id_kab_kota=$id_kab_kota");
                                        $no = 1;

                                        ?>
                                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="width:20px;">No.</th>
                                                    <th>Nama PPIU</th>
                                                    <th style="width: 80px;">Tanggal</th>
                                                    <th>Jam</th>
                                                    <th>Jumlah Jemaah</th>
                                                    <th>Tanggal Keberangkatan</th>
                                                    <th>Tanggal Kepulangan</th>
                                                    <th style="width: 5%;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                while ($tampil = mysqli_fetch_array($query)) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $tampil['nama_ppiu']; ?></td>
                                                        <td><?php
                                                            $tanggal = date('d-m-Y', strtotime($tampil['tanggal']));
                                                            echo $tanggal; ?></td>
                                                        <td><?php echo $tampil['jam']; ?></td>
                                                        <td><?php echo $tampil['jumlah_jemaah_laki_laki'] + $tampil['jumlah_jemaah_wanita']; ?></td>
                                                        <td><?php
                                                            $tanggal_keberangkatan = date('d-m-Y', strtotime($tampil['tanggal_keberangkatan']));
                                                            echo $tanggal_keberangkatan; ?></td>
                                                        <td><?php
                                                            $tanggal_kepulangan = date('d-m-Y', strtotime($tampil['tanggal_kepulangan']));
                                                            echo $tanggal_kepulangan; ?></td>
                                                        <td>
                                                            <a id="detail" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-detail" data-id_pengawasan="<?php echo $tampil['id_pengawasan']; ?>" data-nama_ppiu="<?php echo $tampil['nama_ppiu']; ?>" data-hari="<?php echo $tampil['hari']; ?>" data-tanggal="<?php echo $tanggal; ?>" data-jam="<?php echo $tampil['jam']; ?>" data-izin="<?php echo $tampil['izin']; ?>" data-jumlah_jemaah_laki_laki="<?php echo $tampil['jumlah_jemaah_laki_laki']; ?>" data-jumlah_jemaah_wanita="<?php echo $tampil['jumlah_jemaah_wanita']; ?>" data-tanggal_keberangkatan="<?php echo $tanggal_keberangkatan; ?>" data-tanggal_kepulangan="<?php echo $tanggal_kepulangan; ?>" data-temuan_lapangan="<?php echo $tampil['temuan_lapangan']; ?>" data-petugas_1="<?php echo $tampil['petugas_1']; ?>" data-petugas_2="<?php echo $tampil['petugas_2']; ?>">
                                                                <i class="fas fa-fw fa fa-eye"></i>
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
                                    <h4 class="modal-title m-0 font-weight-bold text-primary">Detail</h4>
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
                                                <th>ID Pengawasan</th>
                                                <td><span id="id_pengawasan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>PPIU</th>
                                                <td><span id="nama_ppiu"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Hari</th>
                                                <td><span id="hari"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td><span id="tanggal"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Jam</th>
                                                <td><span id="jam"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Izin</th>
                                                <td><span id="izin"></span></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Jumlah Jemaah<br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;Laki-Laki<br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;Wanita</th>
                                                <td><br><span id="jumlah_jemaah_laki_laki"></span><br><span id="jumlah_jemaah_wanita"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Keberangkatan</th>
                                                <td><span id="tanggal_keberangkatan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Kepulangan</th>
                                                <td><span id="tanggal_kepulangan"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Temuan Lapangan</th>
                                                <td><span id="temuan_lapangan"></span></td>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">Petugas</th>
                                                <td>
                                                    <ol style="padding-left: 20px;">
                                                        <li id="petugas_1"></li>
                                                        <li id="petugas_2"></li>
                                                    </ol>
                                                </td>
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
                                var id_pengawasan = $(this).data('id_pengawasan');
                                var nama_ppiu = $(this).data('nama_ppiu');
                                var hari = $(this).data('hari');
                                var tanggal = $(this).data('tanggal');
                                var jam = $(this).data('jam');
                                var izin = $(this).data('izin');
                                var jumlah_jemaah_laki_laki = $(this).data('jumlah_jemaah_laki_laki');
                                var jumlah_jemaah_wanita = $(this).data('jumlah_jemaah_wanita');
                                var tanggal_keberangkatan = $(this).data('tanggal_keberangkatan');
                                var tanggal_kepulangan = $(this).data('tanggal_kepulangan');
                                var temuan_lapangan = $(this).data('temuan_lapangan');
                                var petugas_1 = $(this).data('petugas_1');
                                var petugas_2 = $(this).data('petugas_2');
                                $('#id_pengawasan').text(id_pengawasan);
                                $('#nama_ppiu').text(nama_ppiu);
                                $('#hari').text(hari);
                                $('#tanggal').text(tanggal);
                                $('#jam').text(jam);
                                $('#izin').text(izin);
                                $('#jumlah_jemaah_laki_laki').text(jumlah_jemaah_laki_laki);
                                $('#jumlah_jemaah_wanita').text(jumlah_jemaah_wanita);
                                $('#tanggal_keberangkatan').text(tanggal_keberangkatan);
                                $('#tanggal_kepulangan').text(tanggal_kepulangan);
                                $('#temuan_lapangan').text(temuan_lapangan);
                                $('#petugas_1').text(petugas_1);
                                $('#petugas_2').text(petugas_2);
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