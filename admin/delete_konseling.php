<?php
include "service/database.php"; // Pastikan jalur file sesuai

// Cek apakah ID diberikan melalui GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan ID
    $query = "DELETE FROM konseling WHERE id = $id";

    if (mysqli_query($db, $query)) {
        echo "Data berhasil dihapus.";
        header("Location: view_konseling.php"); // Redirect ke halaman tabel
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
} else {
    echo "Artikel tidak ditemukan.";
    exit;
}
?>
