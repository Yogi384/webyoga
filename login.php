<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
        "SELECT * FROM user WHERE username='$username' AND password='$password'"
    );

    $data = mysqli_fetch_array($query);

    if ($data) {
        $_SESSION['username'] = $data['username'];
        header("Location: admin.php");
        exit;
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cyberpunk Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box;font-family:'Orbitron',sans-serif}

/* ===== THEME VARIABLE ===== */
body{
  --bg:#050505;
  --card:#0a0a0a;
  --text:#ffffff;
  --accent:#ff003c;
  --input:#0f0f0f;
  --border:#ff003c;
}

body.light{
  --bg:#f4f4f4;
  --card:#ffffff;
  --text:#111;
  --accent:#c7002f;
  --input:#f1f1f1;
  --border:#c7002f;
}

body{
  margin:0;
  min-height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background:var(--bg);
  color:var(--text);
  transition:.3s;
}

/* ===== LOGIN BOX ===== */
.login-box{
  width:360px;
  padding:40px;
  background:var(--card);
  border:2px solid var(--border);
  box-shadow:0 0 20px var(--accent);
  border-radius:10px;
}

.login-box h2{
  text-align:center;
  color:var(--accent);
  margin-bottom:30px;
}

/* ===== FORM ===== */
label{font-size:13px}

input{
  width:100%;
  padding:12px;
  margin:8px 0 20px;
  background:var(--input);
  border:1px solid var(--border);
  color:var(--text);
  border-radius:5px;
}

button{
  width:100%;
  padding:12px;
  background:linear-gradient(135deg,var(--accent),#800020);
  border:none;
  color:#fff;
  cursor:pointer;
  border-radius:5px;
  box-shadow:0 0 15px var(--accent);
}

/* ===== THEME BUTTON ===== */
.theme-toggle{
  position:absolute;
  top:20px;
  right:20px;
  background:transparent;
  border:1px solid var(--border);
  color:var(--accent);
  padding:8px 12px;
  cursor:pointer;
  border-radius:5px;
  font-size:12px;
}

.footer{
  text-align:center;
  margin-top:15px;
  font-size:11px;
  opacity:.7;
}
</style>
</head>

<body>

<button class="theme-toggle" onclick="toggleTheme()">🌓 Tema</button>

<div class="login-box">
  <h2>LOGIN SYSTEM</h2>

  <form method="POST">
    <label>USERNAME</label>
    <input type="text" name="username" required>

    <label>PASSWORD</label>
    <input type="password" name="password" required>

    <button name="login">ACCESS</button>
  </form>

  <div class="footer">CYBERPUNK AUTH • PHP SESSION</div>
</div>

<script>
const body = document.body;

function loadTheme(){
  if(localStorage.getItem("theme")==="light"){
    body.classList.add("light");
  }
}

function toggleTheme(){
  body.classList.toggle("light");
  localStorage.setItem(
    "theme",
    body.classList.contains("light") ? "light" : "dark"
  );
}

loadTheme();
</script>

</body>
</html>
