<?php
include "session_ppiu.php";

if (isset($_POST['simpan'])) {

    if (empty($_POST["id_ppiu"]) || empty($_POST["tanggal"]) || empty($_POST["jam"]) || empty($_POST["izin"]) || empty($_POST["jumlah_jemaah_laki_laki"]) || empty($_POST["jumlah_jemaah_wanita"]) || empty($_POST["tanggal_keberangkatan"]) || empty($_POST["tanggal_kepulangan"]) || empty($_POST["temuan_lapangan"]) || empty($_POST["petugas_1"]) || empty($_POST["petugas_2"])) {
        $gagal = "Isian Dengan Tanda (*) Tidak Boleh Kososng!";
    } else {
        $id_ppiu = $_POST['id_ppiu'];
        $tanggal = $_POST['tanggal'];
        $day = date('l', strtotime($tanggal));

        $hari_array = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');

        $hari = $hari_array[$day];

        $jam = $_POST['jam'];
        $izin = $_POST['izin'];
        $jumlah_jemaah_laki_laki = $_POST['jumlah_jemaah_laki_laki'];
        $jumlah_jemaah_wanita = $_POST['jumlah_jemaah_wanita'];
        $tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
        $tanggal_kepulangan = $_POST['tanggal_kepulangan'];
        $temuan_lapangan = $_POST['temuan_lapangan'];
        $petugas_1 = $_POST['petugas_1'];
        $petugas_2 = $_POST['petugas_2'];

        $query = mysqli_query($koneksi, "INSERT INTO `pengawasan`(`hari`, `tanggal`, `jam`, `id_ppiu`, `izin`, `jumlah_jemaah_laki_laki`, `jumlah_jemaah_wanita`, `tanggal_keberangkatan`, `tanggal_kepulangan`, `temuan_lapangan`, `petugas_1`, `petugas_2`) VALUES ('$hari','$tanggal','$jam',$id_ppiu,'$izin',$jumlah_jemaah_laki_laki,$jumlah_jemaah_wanita,'$tanggal_keberangkatan','$tanggal_kepulangan','$temuan_lapangan','$petugas_1','$petugas_2');");
        if ($query) {
            $berhasil = "Berhasil Menyimapan Data!";
        } else {
            $gagal = "Gagal Menyimpan Data!";
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
    <title>Blanko Pengawasan Umrah</title>

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
                                    <h6 class="m-0 font-weight-bold text-primary">Blanko Pengawasan Umrah</h6>
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
                                <!-- Card Body -->
                                <div class="card-body">
                                    <a href="pengawasan.php" type="button" class="btn btn-outline-warning btn-sm mb-3">
                                        <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                    <form class="row g-2 mt-3" action="blanko_pengawasan_umrah.php" method="POST" id="form" enctype="multipart/form-data">
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Tanggal</label><label style="color: red;">*</label>
                                            <input type="hidden" class="form-control" id="input1" name="id_ppiu" value="<?php echo $result['id_ppiu']; ?>">
                                            <input autofocus type="date" class="form-control" id="input1" name="tanggal">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Jam</label><label style="color: red;">*</label>
                                            <input autofocus type="time" class="form-control" id="input1" name="jam">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="input1" class="form-label">Izin</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="izin">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Jumlah Jemaah Laki-Laki</label><label style="color: red;">*</label>
                                            <input autofocus type="number" class="form-control" id="input1" name="jumlah_jemaah_laki_laki">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Jumlah Jemaah Wanita</label><label style="color: red;">*</label>
                                            <input autofocus type="number" class="form-control" id="input1" name="jumlah_jemaah_wanita">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Tanggal Keberangkatan</label><label style="color: red;">*</label>
                                            <input autofocus type="date" class="form-control" id="input1" name="tanggal_keberangkatan">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Tanggal Kepulangan</label><label style="color: red;">*</label>
                                            <input autofocus type="date" class="form-control" id="input1" name="tanggal_kepulangan">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom04" class="form-label">Temuan Lapangan</label><label style="color: red;">*</label>
                                            <textarea class="form-control" name="temuan_lapangan" id="validationCustom04" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Petugas 1</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="petugas_1">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Petugas 2</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="petugas_2">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <center>
                                                <button type="submit" class="btn btn-outline-primary btn-sm mt-5 mb-3" name="simpan" id="simpan">
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