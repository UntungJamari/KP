<?php
include "session_kab_kota.php";

if (isset($_POST['simpan'])) {

    $id_ppiu = $_POST['id_ppiu'];

    if (empty($_POST["nama_ppiu"]) || empty($_POST["status"]) || empty($_POST["nomor_sk"]) || empty($_POST["tanggal_sk"]) || empty($_POST["alamat"])) {
        $gagal = "Isian Dengan Tanda (*) Tidak Boleh Kososng!";
    } else {
        $nama_ppiu = $_POST['nama_ppiu'];
        $id_kab_kota = $_POST['id_kab_kota'];
        $nama_pimpinan = $_POST['nama_pimpinan'];
        $status = $_POST['status'];
        $nomor_sk = $_POST['nomor_sk'];
        $tanggal_sk = $_POST['tanggal_sk'];
        $alamat = $_POST['alamat'];


        $image = $_FILES['logo']['name'];

        if (!empty($image)) {

            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $image = $_FILES['logo']['name'];
            $x = explode('.', $image);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['logo']['size'];
            $file_tmp = $_FILES['logo']['tmp_name'];
            $image = $id_ppiu . '.' . $ekstensi;

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 1044070) {
                    move_uploaded_file($file_tmp, '../images/profile/' . $image);
                    $query = mysqli_query($koneksi, "update ppiu set nama_ppiu='$nama_ppiu', nama_pimpinan='$nama_pimpinan', status='$status', nomor_sk='$nomor_sk', tanggal_sk='$tanggal_sk', alamat='$alamat', logo='$image' where id_ppiu='$id_ppiu'");
                    if ($query) {
                        $berhasil = "Berhasil Menyimapan Data!";
                    } else {
                        $gagal = "Gagal Menyimpan Data!";
                    }
                } else {
                    $gagal = "Ukuran File Gambar Terlalu Besar";
                }
            } else {
                $gagal = "Ekstensi File Gambar Tidak Diperbolehkan";
            }
        } else {
            $query = mysqli_query($koneksi, "update ppiu set nama_ppiu='$nama_ppiu', nama_pimpinan='$nama_pimpinan', status='$status', nomor_sk='$nomor_sk', tanggal_sk='$tanggal_sk', alamat='$alamat' where id_ppiu='$id_ppiu'");

            if ($query) {
                $berhasil = "Berhasil Menyimapan Data!";
            } else {
                $gagal = "Gagal Menyimpan Data!";
            }
        }
    }

    $_GET['id_ppiu'] = $id_ppiu;
}

if ((isset($_GET['reset_password'])) && (isset($_GET['username']))) {

    $username = $_GET['username'];
    $password = "12345678";
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = mysqli_query($koneksi, "update user set password='$password' where username='$username'");
    if ($query) {
        $berhasil = "Berhasil Menyimapan Data!";
    } else {
        $gagal = "Gagal Menyimpan Data!";
    }
    $query = mysqli_query($koneksi, "select * from ppiu where username='$username'");
    $result = mysqli_fetch_assoc($query);
    $_GET['id_ppiu'] = $result['id_ppiu'];
}

if (!isset($_GET['id_ppiu'])) {
    header("location:dashboard_kab_kota.php?edit_id_ppiu=Kosong");
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
    <title>Edit PPIU</title>

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
                        <h1 class="h3 mb-0 text-gray-800">PPIU</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit PPIU</h6>
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
                                    <a href="dashboard_kab_kota.php" type="button" class="btn btn-outline-warning btn-sm mb-3">
                                        <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                    <?php

                                    $id_ppiu = $_GET['id_ppiu'];

                                    $query = mysqli_query($koneksi, "select * from ppiu WHERE id_ppiu = '$id_ppiu'");
                                    $result = mysqli_fetch_assoc($query);

                                    ?>
                                    <form class="row g-2 mt-3" action="edit_ppiu.php" method="POST" id="form" enctype="multipart/form-data" data-flag="0">
                                        <div class="col-md-12 form-group mt-5">
                                            <center>
                                                <h4 class="mb-3">Akun PPIU</h4>
                                            </center>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Username</label>
                                            <input autofocus type="text" class="form-control" id="input1" value="<?php echo $result['username']; ?>" disabled>
                                            <input autofocus type="hidden" class="form-control" id="input1" name="username" value="<?php echo $result['username']; ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Reset Password</label>
                                            <input type="submit" onclick="konfirmasi()" class="btn btn-primary btn-user btn-block" id="reset_password" name="reset_password" value="Default : 12345678">
                                        </div>
                                    </form>
                                    <hr>
                                    <form class="row g-2 mt-3" action="edit_ppiu.php" method="POST" id="form" enctype="multipart/form-data">
                                        <div class="col-md-12 form-group">
                                            <center>
                                                <h4 class="mb-3">Data PPIU</h4>
                                            </center>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="input1" class="form-label">Nama PPIU</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="nama_ppiu" value="<?php echo $result['nama_ppiu'] ?>">
                                            <input type="hidden" class="form-control" name="id_kab_kota" value="<?php echo $result['id_kab_kota']; ?>">
                                            <input type="hidden" class="form-control" name="id_ppiu" value="<?php echo $result['id_ppiu']; ?>">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Nama Pimpinan</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="nama_pimpinan" value="<?php echo $result['nama_pimpinan']; ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input2" class="form-label">Status</label><label style="color: red;">*</label>
                                            <select class="form-control" name="status" id="input2">
                                                <?php

                                                if ($result['status'] == 'Pusat') {
                                                ?>
                                                    <option value="Pusat" selected>Pusat</option>
                                                    <option value="Cabang">Cabang</option>

                                                <?php
                                                } else {
                                                ?>
                                                    <option value="Pusat">Pusat</option>
                                                    <option value="Cabang" selected>Cabang</option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Nomor SK</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="nomor_sk" value="<?php echo $result['nomor_sk']; ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Tanggal SK</label><label style="color: red;">*</label>
                                            <input autofocus type="date" class="form-control" id="input1" name="tanggal_sk" value="<?php echo $result['tanggal_sk']; ?>">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom04" class="form-label">Alamat</label><label style="color: red;">*</label>
                                            <textarea class="form-control" name="alamat" id="validationCustom04" cols="30" rows="3"><?php echo $result['alamat']; ?></textarea>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label class="form-label">Logo</label><br>
                                            <center>
                                                <img src="../images/profile/<?php echo $result['logo']; ?>" height="200px">
                                            </center>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="input1" class="form-label">-</label>
                                            <br>
                                            <input type="file" id="file" name="logo" style="display: none;">
                                            <label for="file" class="btn btn-primary btn-user btn-block">
                                                <i class="fas fa-fw fa fa-images">
                                                </i>
                                                Pilih Gambar
                                            </label>
                                            <p style="font-size: 12px; color: #8f8f8f;">*ukuran file maksimal 1 mb dan format file : .jpg, .jpeg, .png</p>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label class="form-label">-</label><br>
                                            <center>
                                                <img id="upload-img" height="0px">
                                            </center>
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

        <script>
            $(document).on('click', '#reset_password', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda Yakin Ingin Mereset Password?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#26c0fc',
                    cancelButtonColor: '#f51d50',
                    cancelButtonText: 'Tidak!',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'edit_ppiu.php?reset_password=true&username=<?php echo $result['username']; ?>'
                    }
                })
            })
        </script>

        <script>
            $(function() {
                $("#file").change(function(event) {
                    var x = URL.createObjectURL(event.target.files[0]);
                    $("#upload-img").attr("src", x);
                    $("#upload-img").attr("height", "200px");
                    console.log(event);
                });
            })
        </script>

</body>

</html>