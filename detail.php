<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM anime WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html>
<head>
<title><?= $row['judul']; ?></title>
</head>
<body>
<h1><?= $row['judul']; ?></h1>
<p><b>Genre:</b> <?= $row['genre']; ?></p>
<p><b>Episode:</b> <?= $row['episode']; ?></p>
<p><?= $row['deskripsi']; ?></p>
<a href="index.php">← Kembali</a>
</body>
</html>