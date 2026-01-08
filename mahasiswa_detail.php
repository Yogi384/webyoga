<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Mahasiswa</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
*{font-family:'Orbitron',sans-serif}
body{
  --bg:#050505;--card:#0a0a0a;--text:#fff;--accent:#ff003c;
}
body.light{
  --bg:#f4f4f4;--card:#fff;--text:#111;--accent:#c7002f;
}
body{background:var(--bg);color:var(--text);transition:.3s;min-height:100vh}
.navbar,.card,footer{background:var(--card)!important;border:1px solid var(--accent)}
.theme-toggle{border:1px solid var(--accent);background:transparent;color:var(--accent);padding:6px 10px}
#datetime{color:var(--accent);font-size:13px}

body:not(.light) {color: #ffffff !important;}
body:not(.light) p, body:not(.light) li, body:not(.light) label, body:not(.light) h1, body:not(.light) h2, body:not(.light) h3, body:not(.light) h4, body:not(.light) h5 {color: #ffffff !important;}
body:not(.light) strong {color: #ff003c !important;}
body:not(.light) .detail-value {color: #ffffff !important;}
body:not(.light) .btn {color: #ffffff !important;}

.detail-row{
  display:flex;
  padding:15px 0;
  border-bottom:1px solid rgba(255,0,60,0.3);
}
.detail-label{
  width:180px;
  font-weight:600;
  color:var(--accent);
}
.detail-value{
  flex:1;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar fixed-top">
  <div class="container">
    <span class="navbar-brand fw-bold text-danger">DETAIL MAHASISWA</span>
    <span id="datetime" class="ms-3 fw-bold"></span>
    <span class="badge bg-danger ms-3">👤 <?php echo $_SESSION['username']; ?></span>
    <div class="ms-auto d-flex gap-2">
      <a href="mahasiswa.php" class="btn btn-outline-light btn-sm">← Kembali</a>
      <button class="theme-toggle" onclick="toggleTheme()">🌙 Tema</button>
    </div>
  </div>
</nav>

<!-- DETAIL -->
<div class="container mt-5 pt-5">
  <div class="card p-4 mt-4" style="max-width:700px;margin:0 auto">
    <h2 class="fw-bold mb-4 text-center">👤 Detail Data Mahasiswa</h2>

    <div class="detail-row">
      <div class="detail-label">NIM</div>
      <div class="detail-value"><?php echo $data['nim']; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Nama Lengkap</div>
      <div class="detail-value"><?php echo $data['nama']; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Program Studi</div>
      <div class="detail-value"><?php echo $data['prodi']; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Kelas</div>
      <div class="detail-value"><?php echo $data['kelas']; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Alamat</div>
      <div class="detail-value"><?php echo $data['alamat'] ?: '-'; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Telepon</div>
      <div class="detail-value"><?php echo $data['telepon'] ?: '-'; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Email</div>
      <div class="detail-value"><?php echo $data['email'] ?: '-'; ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Tanggal Dibuat</div>
      <div class="detail-value"><?php echo date('d F Y H:i', strtotime($data['created_at'])); ?></div>
    </div>

    <div class="d-flex gap-2 mt-4">
      <a href="mahasiswa_update.php?id=<?php echo $data['id']; ?>" class="btn btn-warning flex-fill">
        <i class="bi bi-pencil"></i> Edit
      </a>
      <a href="mahasiswa_delete.php?id=<?php echo $data['id']; ?>" 
         class="btn btn-danger flex-fill"
         onclick="return confirm('Yakin ingin menghapus data ini?')">
        <i class="bi bi-trash"></i> Hapus
      </a>
      <a href="mahasiswa.php" class="btn btn-secondary flex-fill">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
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