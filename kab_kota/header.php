<?php

$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "select * from kemenag_kab_kota where username='$username'");
$result = mysqli_fetch_assoc($query);

?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Judul -->
    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 ">
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php
                    $username_h = ucwords(str_replace("_", " ", $_SESSION['username']));
                    echo $username_h;
                    ?>
                </span>
                <img class="img-profile rounded-circle" src="../images/<?php echo $result['logo']; ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="lihat_profil.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../otentikasi/logout.php" id="btn-logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugin/datatables/dataTables.bootstrap5.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="../plugin/sweetalert2/sweetalert2.min.css">
    <script src="../plugin/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).on('click', '#btn-logout', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin Ingin Logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#26c0fc',
                cancelButtonColor: '#f51d50',
                cancelButtonText: 'Tidak!',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '../otentikasi/logout.php'
                }
            })
        })
    </script>

</nav>
<!-- End of Topbar -->