<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

$id = $_GET['id'];

// Ambil data mahasiswa berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_array($query);

// Proses update data
if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $query_update = mysqli_query($conn, 
        "UPDATE mahasiswa SET 
         nim='$nim', nama='$nama', prodi='$prodi', kelas='$kelas', 
         alamat='$alamat', telepon='$telepon', email='$email' 
         WHERE id='$id'"
    );

    if ($query_update) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href='mahasiswa.php';
              </script>";
    } else {
        echo "<script>alert('Gagal update data: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data Mahasiswa</title>
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

body:not(.light) {color: #ffffff;}
body:not(.light) p, body:not(.light) label {color: #ffffff !important;}

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
    <span class="navbar-brand fw-bold text-danger">EDIT MAHASISWA</span>
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
    <h2 class="fw-bold mb-4 text-center">✏️ Edit Data Mahasiswa</h2>

    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">NIM *</label>
        <input type="text" name="nim" class="form-control" value="<?php echo $data['nim']; ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nama Lengkap *</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Program Studi *</label>
          <select name="prodi" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="Teknik Informatika" <?php if($data['prodi']=='Teknik Informatika') echo 'selected'; ?>>Teknik Informatika</option>
            <option value="Sistem Informasi" <?php if($data['prodi']=='Sistem Informasi') echo 'selected'; ?>>Sistem Informasi</option>
            <option value="Teknologi Informasi" <?php if($data['prodi']=='Teknologi Informasi') echo 'selected'; ?>>Teknologi Informasi</option>
            <option value="Desain Komunikasi Visual" <?php if($data['prodi']=='Desain Komunikasi Visual') echo 'selected'; ?>>Desain Komunikasi Visual</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Kelas *</label>
          <input type="text" name="kelas" class="form-control" value="<?php echo $data['kelas']; ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3"><?php echo $data['alamat']; ?></textarea>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Telepon</label>
          <input type="text" name="telepon" class="form-control" value="<?php echo $data['telepon']; ?>">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>">
        </div>
      </div>

      <div class="d-grid gap-2 mt-4">
        <button type="submit" name="update" class="btn btn-cyber">
          <i class="bi bi-check-circle"></i> UPDATE DATA
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