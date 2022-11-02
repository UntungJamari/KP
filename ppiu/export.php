<?php

include "session_ppiu.php";
$username = $_SESSION['username'];

?>
<link rel="stylesheet" href="../plugin/sweetalert2/sweetalert2.min.css">
<script src="../plugin/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="../plugin/table-to-excel-master/dist/tableToExcel.js"></script>
<table id="table1" data-cols-width="4,14,12,12,30,20,10,10,14,14,20,20,20" style="color: white;">
    <tr>
        <th data-a-h="center" colspan="13">Format Pengisian Blanko Pengawasan Umrah</th>
    </tr>
    <tr>
        <?php

        $query = mysqli_query($koneksi, "select * from ppiu where username='$username'");
        $result = mysqli_fetch_assoc($query);

        ?>
        <th data-a-h="center" colspan="13"><?php echo $result['nama_ppiu']; ?></th>
    </tr>
    <tr>
        <th data-a-h="center" colspan="13">Tahun 2022</th>
    </tr>
    <tr>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="medium" data-f-bold="true" rowspan="2">No</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">Hari</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">Tanggal</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">Jam</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">PPIU</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">Izin</th>
        <th data-a-h="center" data-b-b-s="thin" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" colspan="2">Jumlah Jemaah</th>
        <th data-a-h="center" data-b-b-s="thin" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" colspan="2">Tanggal</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">Temuan Lapangan</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-f-bold="true" rowspan="2">Petugas 1</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-t-s="medium" data-b-l-s="thin" data-b-r-s="medium" data-f-bold="true" rowspan="2">Petugas 2</th>
    </tr>
    <tr>
        <th data-a-h="center" data-b-b-s="medium" data-b-l-s="thin" data-f-bold="true">Laki-laki</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-l-s="thin" data-f-bold="true">Wanita</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-l-s="thin" data-f-bold="true">Keberangkatan</th>
        <th data-a-h="center" data-b-b-s="medium" data-b-l-s="thin" data-f-bold="true">Kepulangan</th>
    </tr>
    <?php

    $query = mysqli_query($koneksi, "select * from pengawasan, ppiu where pengawasan.id_ppiu=ppiu.id_ppiu and ppiu.username='$username'");
    $no = 1;
    while ($tampil = mysqli_fetch_array($query)) {

    ?>
        <tr>
            <td data-b-l-s="medium" data-t="n"><?php echo $no; ?></td>
            <td data-b-l-s="thin"><?php echo $tampil['hari']; ?></td>
            <td data-b-l-s="thin" data-t="d"><?php echo $tampil['tanggal']; ?></td>
            <td data-b-l-s="thin"><?php echo $tampil['jam']; ?></td>
            <td data-b-l-s="thin"><?php echo $tampil['nama_ppiu']; ?></td>
            <td data-b-l-s="thin"><?php echo $tampil['izin']; ?></td>
            <td data-b-l-s="thin" data-t="n"><?php echo $tampil['jumlah_jemaah_laki_laki']; ?></td>
            <td data-b-l-s="thin" data-t="n"><?php echo $tampil['jumlah_jemaah_wanita']; ?></td>
            <td data-b-l-s="thin" data-t="d"><?php echo $tampil['tanggal_keberangkatan']; ?></td>
            <td data-b-l-s="thin" data-t="d"><?php echo $tampil['tanggal_kepulangan']; ?></td>
            <td data-b-l-s="thin"><?php echo $tampil['temuan_lapangan']; ?></td>
            <td data-b-l-s="thin"><?php echo $tampil['petugas_1']; ?></td>
            <td data-b-l-s="thin" data-b-r-s="medium"><?php echo $tampil['petugas_2']; ?></td>
        </tr>
    <?php

        $no++;
    }

    ?>

    <tr>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
        <td data-b-t-s="medium"></td>
    </tr>

</table>
<!-- <button onclick="exporttabel()">export</button> -->
<script>
    // function exporttabel() {
    //     TableToExcel.convert(document.getElementById("table1"), {
    //         name: "table1.xlsx",
    //         sheet: {
    //             name: "Sheet 1"
    //         }
    //     });
    // }

    TableToExcel.convert(document.getElementById("table1"), {
        name: "Blanko Pengawasan Umrah " + "<?php echo $result['nama_ppiu']; ?>" + ".xlsx",
        sheet: {
            name: "Sheet 1"
        }
    });

    swal.fire({
        icon: 'success',
        showConfirmButton: false,
        timer: '2000',
        title: 'File Anda Telah Didownload'
    }).then((result) => {
        window.close();
    })
</script>