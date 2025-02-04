<?php
include "service/database.php"; // Pastikan jalur file sesuai

// Cek apakah ID diberikan melalui GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan ID
    $query = "DELETE FROM santri WHERE id = $id";

    if (mysqli_query($db, $query)) {
        echo "Data berhasil dihapus.";
        header("Location: tables.php"); // Redirect ke halaman tabel
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>
