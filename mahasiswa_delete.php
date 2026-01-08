<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

$id = $_GET['id'];

// Proses hapus data
$query = mysqli_query($conn, "DELETE FROM mahasiswa WHERE id='$id'");

if ($query) {
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href='mahasiswa.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($conn) . "');
            window.location.href='mahasiswa.php';
          </script>";
}
?>