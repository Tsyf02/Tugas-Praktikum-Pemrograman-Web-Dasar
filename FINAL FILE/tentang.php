<?php
session_start();
// tentang.php accessible to logged-in users; allow public view too
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="author" content="Talitha Syifa Al Fath_124250173 & Marva H._124250159">
<meta name="description" content="SIPemandiri - Tentang Sistem">
<title>Tentang — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <a class="navbar-brand" href="index.php">
        <img src="assets/images/LOGOUNGU.png" alt="Violet Restaurant Logo">
    </a>
    <nav>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>
        <?php endif; ?>
        <?php if(isset($_SESSION['login'])): ?>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
        <a href="statistik.php" data-i18n="nav_statistik">Statistik</a>
        <a href="tentang.php" class="active" data-i18n="nav_tentang">Tentang</a>
        <a href="profil.php" data-i18n="nav_profil">Profil</a>
        <a href="logout.php" data-i18n="nav_logout">Logout</a>
        <?php else: ?>
        <a href="login.php" data-i18n="nav_login">Login</a>
        <a href="tentang.php" class="active" data-i18n="nav_tentang">Tentang</a>
        <?php endif; ?>
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

<section class="about-section">
    <div class="about-container">

        <div class="about-title">
            <h1 data-i18n="about_title">Tentang Sistem Informasi</h1>
            <p>
                "Sistem Informasi Pemetaan Lokasi &amp; Data Mandiri Penduduk Non-Permanen
                dibuat untuk membantu proses pendataan penghuni kost dan rumah kontrakan
                secara digital, modern, cepat, dan lebih terintegrasi berbasis web."
            </p>
        </div>

        <div class="about-grid">
            <div class="about-card">
                <h2>📌 Tujuan Sistem</h2>
                <p>Membantu pemerintah daerah maupun lingkungan RT/RW dalam melakukan
                   pendataan penduduk non-permanen secara lebih efektif dan terstruktur.</p>
            </div>
            <div class="about-card">
                <h2>🌐 Teknologi</h2>
                <p>Website ini dibangun menggunakan PHP, MySQL, HTML, CSS, dan JavaScript
                   dengan tampilan modern serta mudah digunakan.</p>
            </div>
            <div class="about-card">
                <h2>📊 Fitur Sistem</h2>
                <p>Pendataan penghuni, pemetaan lokasi tempat tinggal, statistik visual,
                   manajemen user, dan profil pengguna yang dapat dikustomisasi.</p>
            </div>
        </div>

        <div class="info-box" style="margin-top:40px;">
            <h1>📍 Informasi Tambahan</h1>
            <p>
                Sistem ini diharapkan dapat membantu proses digitalisasi pendataan masyarakat
                khususnya penghuni kost dan kontrakan sehingga data menjadi lebih akurat,
                aman, dan mudah diakses kapan saja. Selain itu sistem ini juga mendukung
                proses pemetaan lokasi tempat tinggal untuk mempermudah monitoring wilayah.
            </p>
        </div>

    </div>
</section>

<footer>
    © 2026 Sistem Informasi Penduduk Non-Permanen Berbasis Web<br><br>
    <strong>Tim Pengembang</strong><br>
    Rasya Marva Hervian (124250159) &nbsp;|&nbsp; Talitha Syifa Al Fath (124250173)
</footer>

<script src="toggle.js"></script>
</body>
</html>
