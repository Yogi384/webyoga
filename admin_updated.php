<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
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
body{background:var(--bg);color:var(--text);transition:.3s}
.navbar,.card,footer{background:var(--card)!important;border:1px solid var(--accent)}
.theme-toggle{border:1px solid var(--accent);background:transparent;color:var(--accent);padding:6px 10px}
#datetime{color:var(--accent);font-size:13px}

/* FIX WARNA TEKS SAAT DARK MODE */
body:not(.light) {
  color: #ffffff;
}

body:not(.light) p,
body:not(.light) li,
body:not(.light) span,
body:not(.light) label {
  color: #ffffff !important;
}

body:not(.light) strong {
  color: #ff003c;
}

/* MENU CARD HOVER EFFECT */
.menu-card{
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  display: block;
}
.menu-card:hover{
  transform: translateY(-5px);
  box-shadow: 0 0 20px var(--accent);
}
</style>
</head>

<body>

<!-- ===== NAVBAR + JAM ===== -->
<nav class="navbar fixed-top">
  <div class="container">
    <span class="navbar-brand fw-bold text-danger">ADMIN PANEL</span>

    <!-- JAM -->
    <span id="datetime" class="ms-3 fw-bold"></span>

    <span class="badge bg-danger ms-3">
      👤 <?php echo $_SESSION['username']; ?>
    </span>

    <div class="ms-auto d-flex gap-2">
      <button class="theme-toggle" onclick="toggleTheme()">🌙 Tema</button>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<!-- ===== BERANDA ===== -->
<section class="text-center py-5 mt-5">
  <div class="container py-5">
    <h1 class="fw-bold">Website Mahasiswa Informatika</h1>
    <p class="lead">Selamat datang di dashboard admin.</p>
  </div>
</section>

<!-- ===== MENU UTAMA ===== -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold mb-4 text-center">Menu Utama</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <a href="mahasiswa.php" class="menu-card card p-4 text-center">
          <i class="bi bi-people fs-1 text-danger mb-3"></i>
          <h4 class="fw-bold">Data Mahasiswa</h4>
          <p class="mb-0">Kelola data mahasiswa (CRUD)</p>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#identitas" class="menu-card card p-4 text-center">
          <i class="bi bi-person-badge fs-1 text-danger mb-3"></i>
          <h4 class="fw-bold">Identitas</h4>
          <p class="mb-0">Lihat identitas mahasiswa</p>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#galeri" class="menu-card card p-4 text-center">
          <i class="bi bi-images fs-1 text-danger mb-3"></i>
          <h4 class="fw-bold">Galeri</h4>
          <p class="mb-0">Lihat galeri foto</p>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ===== IDENTITAS MAHASISWA ===== -->
<section class="py-5" id="identitas">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Identitas Mahasiswa</h2>

    <div class="card mx-auto shadow-sm" style="max-width:500px;">
      <div class="card-body text-start">
        <ul class="list-unstyled mb-0">
          <li><strong>Nama</strong> : Nalendra Yogatama</li>
          <li><strong>NIM</strong> : A11.2024.15569</li>
          <li><strong>Program Studi</strong> : Teknik Informatika</li>
          <li><strong>Kelas</strong> : 4316</li>
        </ul>
      </div>
    </div>
  </div>
</section>


<!-- ===== ARTIKEL ===== -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Artikel Menarik</h2>
    <div class="row g-4">
      <div class="col-md-4"><div class="card p-3">Biografi Singkat</div></div>
      <div class="col-md-4"><div class="card p-3">Tutorial Website</div></div>
      <div class="col-md-4"><div class="card p-3">Berita Teknologi</div></div>
    </div>
  </div>
</section>

<!-- ===== GALERI ===== -->
<section class="py-5" id="galeri">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Galeri Pribadi</h2>
    <div class="row g-3">
      <div class="col-6 col-md-4"><img src="1.png" class="img-fluid rounded"></div>
      <div class="col-6 col-md-4"><img src="2.png" class="img-fluid rounded"></div>
      <div class="col-6 col-md-4"><img src="3.png" class="img-fluid rounded"></div>
    </div>
  </div>
</section>

<!-- ===== SCHEDULE ===== -->
<section class="py-5 text-center">
  <div class="container">
    <h2 class="fw-bold mb-4">Schedule</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-6 col-md-3"><div class="card p-3"><i class="bi bi-book fs-1 text-danger"></i><h5>Membaca</h5></div></div>
      <div class="col-6 col-md-3"><div class="card p-3"><i class="bi bi-pencil-square fs-1 text-danger"></i><h5>Menulis</h5></div></div>
      <div class="col-6 col-md-3"><div class="card p-3"><i class="bi bi-people fs-1 text-danger"></i><h5>Diskusi</h5></div></div>
      <div class="col-6 col-md-3"><div class="card p-3"><i class="bi bi-bicycle fs-1 text-danger"></i><h5>Olahraga</h5></div></div>
      <div class="col-6 col-md-3"><div class="card p-3"><i class="bi bi-film fs-1 text-danger"></i><h5>Menonton</h5></div></div>
      <div class="col-6 col-md-3"><div class="card p-3"><i class="bi bi-bag fs-1 text-danger"></i><h5>Belanja</h5></div></div>
    </div>
  </div>
</section>

<footer class="text-center py-3">
  <p class="mb-0">&copy; 2025 Nalendra Yogatama</p>
</footer>

<!-- ===== SCRIPT JAM + THEME ===== -->
<script>
const body=document.body;

// THEME
if(localStorage.getItem("theme")==="light") body.classList.add("light");
function toggleTheme(){
  body.classList.toggle("light");
  localStorage.setItem("theme",
    body.classList.contains("light")?"light":"dark");
}

// JAM
function updateDateTime(){
  const now = new Date();
  const opt = {
    weekday:"long", year:"numeric", month:"long", day:"numeric",
    hour:"2-digit", minute:"2-digit", second:"2-digit"
  };
  document.getElementById("datetime").textContent =
    now.toLocaleDateString("id-ID", opt);
}
setInterval(updateDateTime,1000);
updateDateTime();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>