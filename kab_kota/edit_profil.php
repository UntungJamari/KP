<?php
include "session_kab_kota.php";


if (isset($_POST['simpan'])) {
    $id_kemenag_kab_kota = $_POST['id_kemenag_kab_kota'];
    $nama_pimpinan = $_POST['nama_pimpinan'];
    $alamat = $_POST['alamat'];

    $query = mysqli_query($koneksi, "update kemenag_kab_kota set nama_pimpinan = '$nama_pimpinan', alamat = '$alamat' where id_kemenag_kab_kota = $id_kemenag_kab_kota");
    if ($query) {
        $berhasil = "Berhasil Menyimapan Data!";
    } else {
        $gagal = "Gagal Menyimpan Data!";
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
                                    $query = mysqli_query($koneksi, "select * from kemenag_kab_kota, kab_kota where kemenag_kab_kota.id_kab_kota=kab_kota.id_kab_kota and kemenag_kab_kota.username='$username'");
                                    $result = mysqli_fetch_assoc($query);

                                    ?>
                                    <center>
                                        <img src="../images/<?php echo $result['logo']; ?>" style="width: 250px;" class="mb-5">
                                        <h4 class="mb-3">Kementerian Agama <?php echo $result['nama_kab_kota']; ?></h4>
                                    </center>
                                    <form class="row g-2" action="edit_profil.php" method="POST">
                                        <input type="hidden" name="id_kemenag_kab_kota" value="<?php echo $result['id_kemenag_kab_kota']; ?>">
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">ID</label>
                                            <input type="text" class="form-control" style="background-color: #dee2e6" id="input1" value="<?php echo $result['id_kemenag_kab_kota']; ?>" disabled required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validationCustom02" class="form-label">Username</label>
                                            <input type="text" class="form-control" style="background-color: #dee2e6" id="validationCustom02" name="username" value="<?php echo $result['username']; ?>" disabled required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom03" class="form-label">Nama Pimpinan</label>
                                            <input autofocus type="text" class="form-control" id="validationCustom03" name="nama_pimpinan" value="<?php echo $result['nama_pimpinan']; ?>" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom04" class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="validationCustom04" cols="30" rows="3" required><?php echo $result['alamat']; ?></textarea>
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