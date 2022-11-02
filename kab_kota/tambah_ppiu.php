<?php
include "session_kab_kota.php";

$berhasil = false;

if (isset($_POST['simpan'])) {

    $nama_ppiu = addslashes($_POST['nama_ppiu']);
    $nama_pimpinan = $_POST['nama_pimpinan'];
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
    }
    $nomor_sk = $_POST['nomor_sk'];
    $tanggal_sk = $_POST['tanggal_sk'];
    $alamat = $_POST['alamat'];
    $usernameee = $_POST['username'];

    if (empty($_POST["nama_ppiu"]) || empty($_POST["status"]) || empty($_POST["nomor_sk"]) || empty($_POST["tanggal_sk"]) || empty($_POST["alamat"]) || empty($_POST["username"])) {
        $gagal = "Isian Dengan Tanda (*) Tidak Boleh Kososng!";
    } else {
        $nama_ppiu = addslashes($_POST['nama_ppiu']);
        $id_kab_kota = $_POST['id_kab_kota'];
        $nama_pimpinan = $_POST['nama_pimpinan'];
        $status = $_POST['status'];
        $nomor_sk = $_POST['nomor_sk'];
        $tanggal_sk = $_POST['tanggal_sk'];
        $alamat = $_POST['alamat'];
        $username = $_POST['username'];
        $password = "12345678";
        $password = password_hash($password, PASSWORD_DEFAULT);

        $image = $_FILES['logo']['name'];

        $query = mysqli_query($koneksi, "select * from user where username = '$username'");
        if (mysqli_affected_rows($koneksi) == 0) {

            if (!empty($image)) {

                $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
                $image = $_FILES['logo']['name'];
                $x = explode('.', $image);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['logo']['size'];
                $file_tmp = $_FILES['logo']['tmp_name'];

                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    if ($ukuran < 1044070) {
                        $query = mysqli_query($koneksi, "insert into user values ('$username', '$password', 'ppiu');");
                        $query2 = mysqli_query($koneksi, "INSERT INTO `ppiu`(`username`, `nama_ppiu`, `id_kab_kota`, `status`, `nomor_sk`, `tanggal_sk`, `alamat`, `nama_pimpinan`) VALUES ('$username','$nama_ppiu',$id_kab_kota,'$status','$nomor_sk','$tanggal_sk','$alamat','$nama_pimpinan');");
                        $query4 = mysqli_query($koneksi, "select * from ppiu where username='$username'");
                        $result4 = mysqli_fetch_assoc($query4);
                        $id_ppiu = $result4['id_ppiu'];
                        $image = $id_ppiu . '.' . $ekstensi;
                        move_uploaded_file($file_tmp, '../images/profile/' . $image);
                        $query3 = mysqli_query($koneksi, "update ppiu set logo='$image' where username='$username';");
                        if (($query == false) || ($query2 == false) || ($query3 == false)) {
                            $gagal = "Gagal Menyimpan Data!";
                        } else {
                            $berhasil = "Berhasil Menyimapan Data!";

                            // unset($nama_ppiu, $nama_pimpinan, $status, $nomor_sk, $tanggal_sk, $alamat, $usernameee);
                        }
                    } else {
                        $gagal = "Ukuran File Gambar Terlalu Besar";
                    }
                } else {
                    $gagal = "Ekstensi File Gambar Tidak Diperbolehkan";
                }
            } else {
                $query = mysqli_query($koneksi, "insert into user values ('$username', '$password', 'ppiu');");

                $query2 = mysqli_query($koneksi, "INSERT INTO `ppiu`(`username`, `nama_ppiu`, `id_kab_kota`, `status`, `nomor_sk`, `tanggal_sk`, `alamat`, `nama_pimpinan`) VALUES ('$username','$nama_ppiu',$id_kab_kota,'$status','$nomor_sk','$tanggal_sk','$alamat','$nama_pimpinan');");

                if (($query == false) || ($query2 == false)) {
                    $gagal = "Gagal Menyimpan Data!";
                } else {
                    $berhasil = "Berhasil Menyimapan Data!";
                }
            }
        } else {
            $gagal = "Username $username sudah ada!";
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
    <title>Tambah PPIU</title>

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
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah PPIU</h6>
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
                                    if ($berhasil == true) {
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
                                    <a href="lihat_ppiu.php" type="button" class="btn btn-outline-warning btn-sm mb-3">
                                        <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                    <form class="row g-2 mt-3" action="tambah_ppiu.php" method="POST" id="form" enctype="multipart/form-data">
                                        <div class="col-md-12 form-group">
                                            <center>
                                                <h4 class="mb-3">Data PPIU</h4>
                                            </center>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="input1" class="form-label">Nama PPIU</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="nama_ppiu" <?php
                                                                                                                            if ($berhasil) {
                                                                                                                            } else {
                                                                                                                                if (isset($nama_ppiu)) {
                                                                                                                                    echo 'value="' . $nama_ppiu . '"';
                                                                                                                                }
                                                                                                                            }
                                                                                                                            ?>>
                                            <input type="hidden" class="form-control" name="id_kab_kota" value="<?php echo $result['id_kab_kota']; ?>">

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Nama Pimpinan</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="nama_pimpinan" <?php
                                                                                                                                if ($berhasil) {
                                                                                                                                } else {
                                                                                                                                    if (isset($nama_pimpinan)) {
                                                                                                                                        echo 'value="' . $nama_pimpinan . '"';
                                                                                                                                    }
                                                                                                                                } ?>>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input2" class="form-label">Status</label><label style="color: red;">*</label>
                                            <select class="form-control" name="status" id="input2">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="Pusat" <?php if ($berhasil) {
                                                                        } else {
                                                                            if (isset($status)) {
                                                                                if ($status == "Pusat") {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                        } ?>>Pusat</option>
                                                <option value="Cabang" <?php if ($berhasil) {
                                                                        } else {
                                                                            if (isset($status)) {
                                                                                if ($status == "Cabang") {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                        } ?>>Cabang</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Nomor SK</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="nomor_sk" <?php if ($berhasil) {
                                                                                                                            } else {
                                                                                                                                if (isset($nomor_sk)) {
                                                                                                                                    echo 'value="' . $nomor_sk . '"';
                                                                                                                                }
                                                                                                                            } ?>>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Tanggal SK</label><label style="color: red;">*</label>
                                            <input autofocus type="date" class="form-control" id="input1" name="tanggal_sk" <?php if ($berhasil) {
                                                                                                                            } else {
                                                                                                                                if (isset($tanggal_sk)) {
                                                                                                                                    echo 'value="' . $tanggal_sk . '"';
                                                                                                                                }
                                                                                                                            } ?>>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="validationCustom04" class="form-label">Alamat</label><label style="color: red;">*</label>
                                            <textarea class="form-control" name="alamat" id="validationCustom04" cols="30" rows="3"><?php if ($berhasil) {
                                                                                                                                    } else {
                                                                                                                                        if (isset($alamat)) {
                                                                                                                                            echo $alamat;
                                                                                                                                        }
                                                                                                                                    } ?></textarea>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="input1" class="form-label">Logo</label>
                                            <br>
                                            <input type="file" id="file" name="logo" style="display: none;">
                                            <label for="file" class="btn btn-primary btn-user btn-block">
                                                <i class="fas fa-fw fa fa-images">
                                                </i>
                                                Pilih Gambar
                                            </label>
                                            <img id="upload-img" height="0px">
                                            <p style="font-size: 12px; color: #8f8f8f;">*ukuran file maksimal 1 mb dan format file : .jpg, .jpeg, .png</p>
                                        </div>
                                        <div class="col-md-12 form-group mt-5">
                                            <center>
                                                <h4 class="mb-3">Akun PPIU</h4>
                                            </center>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Username</label><label style="color: red;">*</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="username" <?php if ($berhasil) {
                                                                                                                            } else {
                                                                                                                                if (isset($usernameee)) {
                                                                                                                                    echo 'value="' . $usernameee . '"';
                                                                                                                                }
                                                                                                                            } ?>>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input1" class="form-label">Password</label>
                                            <input autofocus type="text" class="form-control" id="input1" name="password" placeholder="Default : 12345678" disabled>
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