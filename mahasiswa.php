<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

// Proses Pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = mysqli_query($conn, 
        "SELECT * FROM mahasiswa 
         WHERE nim LIKE '%$search%' 
         OR nama LIKE '%$search%' 
         OR prodi LIKE '%$search%' 
         OR kelas LIKE '%$search%'
         ORDER BY nim ASC"
    );
} else {
    // Query untuk mengambil semua data mahasiswa
    $query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nim ASC");
}

// Hitung total data
$total_data = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Mahasiswa</title>
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

/* FIX WARNA TEKS DARK MODE */
body:not(.light) {color: #ffffff;}
body:not(.light) p, body:not(.light) li, body:not(.light) span, body:not(.light) label {color: #ffffff !important;}
body:not(.light) strong {color: #ff003c;}

/* SEARCH INPUT FIX */
body:not(.light) .form-control {
  background: #0f0f0f !important;
  color: #ffffff !important;
  border-color: #ff003c !important;
}
body:not(.light) .form-control::placeholder {
  color: #999999 !important;
}
body:not(.light) .input-group-text {
  background: #ff003c !important;
  border-color: #ff003c !important;
}

/* TABLE STYLING */
.table{
  color:var(--text) !important;
  background:transparent !important;
}
.table thead{
  background:var(--accent) !important;
  color:#fff !important;
}
.table tbody{
  background:var(--card) !important;
}
.table tbody tr{
  background:var(--card) !important;
  border-bottom:1px solid var(--accent);
}
.table tbody tr:hover{
  background:rgba(255,0,60,0.1) !important;
}
.table td, .table th{
  color:var(--text) !important;
  border-color:var(--accent) !important;
  background:transparent !important;
}

/* Fix untuk dark mode - SUPER PENTING */
body:not(.light) .table {
  background: #0a0a0a !important;
}

body:not(.light) .table tbody {
  background: #0a0a0a !important;
}

body:not(.light) .table tbody tr {
  background: #0a0a0a !important;
}

body:not(.light) .table td,
body:not(.light) .table th {
  color: #ffffff !important;
  background: transparent !important;
}

body:not(.light) .table thead th {
  background: #ff003c !important;
  color: #ffffff !important;
}

body:not(.light) .btn-info,
body:not(.light) .btn-warning,
body:not(.light) .btn-danger {
  color: #ffffff !important;
}

/* BUTTON STYLING */
.btn-cyber{
  background:linear-gradient(135deg,var(--accent),#800020);
  border:none;color:#fff;
  box-shadow:0 0 10px var(--accent);
}
.btn-cyber:hover{box-shadow:0 0 20px var(--accent)}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar fixed-top">
  <div class="container">
    <span class="navbar-brand fw-bold text-danger">DATA MAHASISWA</span>
    <span id="datetime" class="ms-3 fw-bold"></span>
    <span class="badge bg-danger ms-3">👤 <?php echo $_SESSION['username']; ?></span>
    <div class="ms-auto d-flex gap-2">
      <a href="admin.php" class="btn btn-outline-light btn-sm">🏠 Dashboard</a>
      <button class="theme-toggle" onclick="toggleTheme()">🌙 Tema</button>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5 pt-5">
  <div class="card p-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold mb-0">📚 Daftar Mahasiswa</h2>
      <a href="mahasiswa_create.php" class="btn btn-cyber">
        <i class="bi bi-plus-circle"></i> Tambah Data
      </a>
    </div>

    <!-- SEARCH BOX -->
    <div class="mb-4">
      <form method="GET" action="" class="row g-3">
        <div class="col-md-10">
          <div class="input-group">
            <span class="input-group-text" style="background:var(--accent);border:1px solid var(--accent)">
              <i class="bi bi-search text-white"></i>
            </span>
            <input type="text" name="search" class="form-control" 
                   placeholder="Cari berdasarkan NIM, Nama, Prodi, atau Kelas..." 
                   value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                   style="background:var(--input);border:1px solid var(--accent);color:var(--text)">
          </div>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-cyber w-100">
            <i class="bi bi-search"></i> Cari
          </button>
        </div>
      </form>
      
      <?php if(isset($_GET['search']) && $_GET['search'] != ''): ?>
      <div class="mt-3">
        <span style="color:var(--text)">
          Hasil pencarian untuk: <strong style="color:var(--accent)">"<?php echo $search; ?>"</strong> 
          - Ditemukan <strong style="color:var(--accent)"><?php echo $total_data; ?></strong> data
        </span>
        <a href="mahasiswa.php" class="btn btn-sm btn-outline-danger ms-3">
          <i class="bi bi-x-circle"></i> Reset
        </a>
      </div>
      <?php endif; ?>
    </div>

    <!-- TABLE -->
    <div class="table-responsive" style="background:var(--card)">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Kelas</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          if($total_data > 0){
            while($data = mysqli_fetch_array($query)){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nim']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['prodi']; ?></td>
            <td><?php echo $data['kelas']; ?></td>
            <td><?php echo $data['telepon']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td>
              <a href="mahasiswa_detail.php?id=<?php echo $data['id']; ?>" 
                 class="btn btn-info btn-sm" title="Detail">
                <i class="bi bi-eye"></i>
              </a>
              <a href="mahasiswa_update.php?id=<?php echo $data['id']; ?>" 
                 class="btn btn-warning btn-sm" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="mahasiswa_delete.php?id=<?php echo $data['id']; ?>" 
                 class="btn btn-danger btn-sm" 
                 onclick="return confirm('Yakin ingin menghapus data ini?')" 
                 title="Hapus">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
          <?php 
            }
          } else {
          ?>
          <tr>
            <td colspan="8" class="text-center py-4" style="color:var(--text)">
              <i class="bi bi-inbox fs-1 d-block mb-2" style="color:var(--accent)"></i>
              <strong>Data tidak ditemukan</strong>
              <?php if(isset($_GET['search'])): ?>
              <br><small>Coba kata kunci lain atau <a href="mahasiswa.php">reset pencarian</a></small>
              <?php endif; ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<footer class="text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 Nalendra Yogatama</p>
</footer>

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