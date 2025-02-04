<?php
include "service/database.php"; // Pastikan file database ada dan benar.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $poin = intval($_POST['poin']);

    $query = "INSERT INTO santri (nama, status, alamat, poin) VALUES ('$nama', '$status', '$alamat', $poin)";
    
    if (mysqli_query($db, $query)) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
        echo "<script>window.location.href='tables.php';</script>"; // Redirect ke halaman tables.php
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
