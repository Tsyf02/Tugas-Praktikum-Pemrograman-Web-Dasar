<?php
session_start();
if(isset($_SESSION['login'])){ header("Location: beranda.php"); exit; }

$conn = mysqli_connect("localhost","root","","db_penduduk");
$error = "";

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $data = mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek  = mysqli_num_rows($data);

    if($cek > 0){
        $user = mysqli_fetch_assoc($data);
        $_SESSION['login']    = true;
        $_SESSION['role']     = $user['role'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['nama']     = $user['nama_lengkap'];
        header("Location: beranda.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="author" content="Talitha Syifa Al Fath_124250173 & Marva H._124250159">
<meta name="description" content="SIPemandiri - Login">
<title>Login — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">📍 SIPeManDiRi</div>
    <nav>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="tentang.php" data-i18n="nav_tentang">Tentang</a>
    </nav>
    <div class="toggle-container">
        <div class="toggle-group">
            <label class="toggle-switch">
                <input type="checkbox" id="darkModeToggle" onchange="toggleDarkMode()">
                <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">
                <span id="darkModeIcon">☀️</span>
                <span id="darkModeText">Light</span>
            </span>
        </div>
        <div class="toggle-group">
            <label class="toggle-switch">
                <input type="checkbox" id="langToggle" onchange="toggleLanguage()">
                <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">
                <span id="langIcon"> </span>
                <span id="langText">ID</span>
            </span>
        </div>
    </div>
</header>

<div class="login-wrap">
    <div class="login-box">
        <div class="logo-login">📍</div>
        <h2>SIPeManDiRi</h2>
        <?php if($error): ?>
            <div class="login-error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>

<script src="toggle.js"></script>
</body>
</html>
