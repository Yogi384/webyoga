
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
<title>Website Nalendra Yogatama</title>
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

body { padding-top: 80px; }

/* NAVBAR TEXT FIX SAAT DARK MODE */
body:not(.light) .navbar-brand,
body:not(.light) .nav-link {
  color: #ffffff !important;
}

body:not(.light) .nav-link:hover {
  color: #ff003c !important;
}

</style>
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
  <div class="container">

<!-- KIRI : BRAND -->
<a class="navbar-brand fw-bold text-dark" href="#">
      Website Nalendra Yogatama
    </a>

    <!-- TOGGLER MOBILE -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse" id="mainNav">

      <!-- MENU TENGAH -->
      <ul class="navbar-nav mx-auto gap-3">
        <li class="nav-item"><a class="nav-link text-dark" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#database">Database</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#artikel">Article</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#galeri">Gallery</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#schedule">Schedule</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#about">About Me</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="login.php">Login</a></li>
      </ul>

      <!-- ICON KANAN -->
      <div class="d-flex gap-2">
        <button class="btn btn-dark btn-sm" onclick="toggleTheme()">🌙</button>
      </div>

    </div>
  </div>
</nav>

<!-- ===== HERO SECTION ===== -->
<section class="py-5" id="home" style="background-color:#f8dada;">
  <div class="container">
    <div class="row align-items-center">

      <!-- TEKS -->
      <div class="col-md-6 mb-4 mb-md-0">
        <h1 class="fw-bold display-5 mb-3">
          Website Buatan<br> Nalendra Yogatama
        </h1>
        <p class="fs-5 mb-3">
          Selamat datang di Web Nalendra Yogatama.
        </p>
        <p class="text-muted">
          Website ini dibuat oleh Nalendra Yogatama.
        </p>
      </div>

      <!-- GAMBAR -->
      <div class="col-md-6 text-center">
        <img src="hero.png" 
             alt="Hero Image"
             class="img-fluid rounded shadow"
             style="max-height:420px;">
      </div>

    </div>
  </div>
</section>


<!-- ===== Konten Database ===== -->
<section class="py-5" id="database">
  <div class="container">
    <h2 class="fw-bold mb-4 text-center">Konten Database</h2>

    <div class="d-flex justify-content-center">
      <div class="col-md-4">

        <a href="mahasiswa.php" class="menu-card card p-4 text-center shadow-sm">
          <i class="bi bi-people fs-1 text-danger mb-3"></i>
          <h4 class="fw-bold">Data Mahasiswa</h4>
          <p class="mb-0">Kelola data mahasiswa (CRUD)</p>
        </a>

      </div>
    </div>

  </div>
</section>


<!-- ===== ARTIKEL ===== -->
<section class="py-5" id="artikel">
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
    <div class="row g-2">
      <div class="col-6 col-md-4"><img src="2.png" class="img-fluid rounded"></div>
      <div class="col-6 col-md-4"><img src="3.png" class="img-fluid rounded"></div>
    </div>
  </div>
</section>

<!-- ===== SCHEDULE ===== -->
<section class="py-5 text-center" id="schedule">
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

<!-- ===== ABOUT ME ===== -->
<section class="py-5" id="about">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">About Me</h2>

    <div class="card mx-auto shadow-sm p-4" style="max-width:600px;">
      <div class="row align-items-center">

        <!-- FOTO PROFIL -->
        <div class="col-md-4 text-center mb-3 mb-md-0">
          <div class="mx-auto" style="width:150px;height:150px;border-radius:50%;overflow:hidden;border:3px solid #dc3545;">
            <img src="profil.jpeg" alt="Foto Profil" style="width:100%;height:100%;object-fit:cover;">
          </div>
        </div>

        <!-- DESKRIPSI -->
        <div class="col-md-8 text-start">
          <p class="mb-2"><strong>Nama:</strong> Nalendra Yogatama</p>
          <p class="mb-2"><strong>NIM:</strong> A11.2024.15569</p>
          <p class="mb-2"><strong>Program Studi:</strong> Teknik Informatika</p>
          <p class="mb-2"><strong>Kelas:</strong> 4316</p>
          <p class="mt-3 text-muted">
            Mahasiswa Teknik Informatika yang tertarik pada pengembangan web dan teknologi informasi.
          </p>
        </div>

      </div>
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