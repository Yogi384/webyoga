<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include "koneksi.php";

// Query untuk mengambil semua data mahasiswa
$query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nim ASC");
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

/* TABLE STYLING */
.table{color:var(--text)}
.table thead{background:var(--accent);color:#fff}
.table tbody tr{background:var(--card);border-bottom:1px solid var(--accent)}
.table tbody tr:hover{background:rgba(255,0,60,0.1)}

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

    <!-- TABLE -->
    <div class="table-responsive">
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