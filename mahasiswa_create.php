<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

// Proses simpan data
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $query = mysqli_query($conn, 
        "INSERT INTO mahasiswa (nim, nama, prodi, kelas, alamat, telepon, email) 
         VALUES ('$nim', '$nama', '$prodi', '$kelas', '$alamat', '$telepon', '$email')"
    );

    if ($query) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href='mahasiswa.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Data Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
*{font-family:'Orbitron',sans-serif}
body{
  --bg:#050505;--card:#0a0a0a;--text:#fff;--accent:#ff003c;--input:#0f0f0f;
}
body.light{
  --bg:#f4f4f4;--card:#fff;--text:#111;--accent:#c7002f;--input:#f1f1f1;
}
body{background:var(--bg);color:var(--text);transition:.3s;min-height:100vh}
.navbar,.card,footer{background:var(--card)!important;border:1px solid var(--accent)}
.theme-toggle{border:1px solid var(--accent);background:transparent;color:var(--accent);padding:6px 10px}
#datetime{color:var(--accent);font-size:13px}

body:not(.light) {color: #ffffff !important;}
body:not(.light) p, body:not(.light) label, body:not(.light) h1, body:not(.light) h2, body:not(.light) h3, body:not(.light) h4, body:not(.light) h5 {color: #ffffff !important;}
body:not(.light) strong {color: #ff003c !important;}
body:not(.light) .btn {color: #ffffff !important;}

/* FORM STYLING */
.form-label{font-size:14px;font-weight:600;color:var(--accent)}
.form-control, .form-select{
  background:var(--input);
  border:1px solid var(--accent);
  color:var(--text);
  padding:12px;
}
.form-control:focus, .form-select:focus{
  background:var(--input);
  border-color:var(--accent);
  color:var(--text);
  box-shadow:0 0 10px var(--accent);
}

.btn-cyber{
  background:linear-gradient(135deg,var(--accent),#800020);
  border:none;color:#fff;padding:12px 30px;
  box-shadow:0 0 10px var(--accent);
}
.btn-cyber:hover{box-shadow:0 0 20px var(--accent);color:#fff}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar fixed-top">
  <div class="container">
    <span class="navbar-brand fw-bold text-danger">TAMBAH MAHASISWA</span>
    <span id="datetime" class="ms-3 fw-bold"></span>
    <span class="badge bg-danger ms-3">👤 <?php echo $_SESSION['username']; ?></span>
    <div class="ms-auto d-flex gap-2">
      <a href="mahasiswa.php" class="btn btn-outline-light btn-sm">← Kembali</a>
      <button class="theme-toggle" onclick="toggleTheme()">🌙 Tema</button>
    </div>
  </div>
</nav>

<!-- FORM -->
<div class="container mt-5 pt-5">
  <div class="card p-4 mt-4" style="max-width:700px;margin:0 auto">
    <h2 class="fw-bold mb-4 text-center">➕ Tambah Data Mahasiswa</h2>

    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">NIM *</label>
        <input type="text" name="nim" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nama Lengkap *</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Program Studi *</label>
          <select name="prodi" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknologi Informasi">Teknologi Informasi</option>
            <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Kelas *</label>
          <input type="text" name="kelas" class="form-control" placeholder="Contoh: 4316" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3"></textarea>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Telepon</label>
          <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="email@student.ac.id">
        </div>
      </div>

      <div class="d-grid gap-2 mt-4">
        <button type="submit" name="simpan" class="btn btn-cyber">
          <i class="bi bi-save"></i> SIMPAN DATA
        </button>
        <a href="mahasiswa.php" class="btn btn-outline-secondary">
          <i class="bi bi-x-circle"></i> BATAL
        </a>
      </div>
    </form>
  </div>
</div>

<!-- SCRIPT -->
<script>
const body=document.body;
if(localStorage.getItem("theme")==="light") body.classList.add("light");
function toggleTheme(){
  body.classList.toggle("light");
  localStorage.setItem("theme", body.classList.contains("light")?"light":"dark");
}

function updateDateTime(){
  const now = new Date();
  const opt = {
    weekday:"long", year:"numeric", month:"long", day:"numeric",
    hour:"2-digit", minute:"2-digit", second:"2-digit"
  };
  document.getElementById("datetime").textContent = now.toLocaleDateString("id-ID", opt);
}
setInterval(updateDateTime,1000);
updateDateTime();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>