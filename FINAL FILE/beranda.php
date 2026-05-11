<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }

// Fetch real stats
$conn = mysqli_connect("localhost","root","","db_penduduk");
$total   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk"))['j'];
$kost    = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk WHERE jenis='Kost'"))['j'];
$kontrak = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk WHERE jenis='Kontrak'"))['j'];
$lokasi  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(DISTINCT alamat) as j FROM penduduk"))['j'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="author" content="Talitha Syifa Al Fath_124250173 & Marva H._124250159">
<meta name="description" content="SIPemandiri - Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen">
<title>Beranda — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png"> 
<!-- img logo di tab -->
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <a class="navbar-brand" href="index.php">
        <img src="assets/images/LOGOUNGU.png" alt="Violet Restaurant Logo">
    </a>
    <nav>
        <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>
        <?php endif; ?>
        <a href="beranda.php" class="active" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
        <a href="statistik.php" data-i18n="nav_statistik">Statistik</a>
        <a href="tentang.php" data-i18n="nav_tentang">Tentang</a>
        <a href="profil.php" data-i18n="nav_profil">Profil</a>
        <a href="logout.php" data-i18n="nav_logout">Logout</a>
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

<section class="hero">
    <h1 data-i18n="hero_title">
        Sistem Informasi Pemetaan Lokasi &amp;<br>
        Data Mandiri Penduduk Non-Permanen<br>
        (Kontrak &amp; Kost) Berbasis Web
    </h1>
    <p data-i18n="hero_desc">
        Website modern berbasis PHP dan MySQL untuk membantu
        pendataan masyarakat non-permanen seperti penghuni
        kost dan rumah kontrakan secara digital.
    </p>
    <a href="pendataan.php">
        <button class="btn" data-i18n="btn_mulai">Mulai Pendataan</button>
    </a>
</section>

<section class="cards">
    <div class="card">
        <h2><?= $total; ?></h2>
        <p data-i18n="card_total">Total Penduduk</p>
    </div>
    <div class="card">
        <h2><?= $kost; ?></h2>
        <p data-i18n="card_kost">Penghuni Kost</p>
    </div>
    <div class="card">
        <h2><?= $kontrak; ?></h2>
        <p data-i18n="card_kontrak">Penghuni Kontrak</p>
    </div>
    <div class="card">
        <h2><?= $lokasi; ?></h2>
        <p data-i18n="card_lokasi">Total Lokasi</p>
    </div>
</section>

<footer data-i18n="footer_text">© 2026 Sistem Informasi Penduduk Non-Permanen Berbasis Web</footer>

<script src="toggle.js"></script>
</body>
</html>
