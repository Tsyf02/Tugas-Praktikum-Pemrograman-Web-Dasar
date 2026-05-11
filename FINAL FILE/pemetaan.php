<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Pemetaan — SIPeManDiRi</title>
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
        <?php if($_SESSION['role'] == 'admin'): ?>"},{
        <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>
        <?php endif; ?>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" class="active" data-i18n="nav_pemetaan">Pemetaan</a>
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

<section class="hero" style="padding-bottom:30px;">
    <h1 data-i18n="peta_title">Pemetaan Lokasi Penduduk</h1>
    <p data-i18n="peta_desc">Halaman ini digunakan untuk melihat persebaran lokasi penghuni kost dan kontrakan.</p>

    <div class="search-box" style="margin-top:28px;">
        <input type="text" id="lokasi" placeholder="Contoh: Depok, Yogyakarta, Kost dekat kampus...">
        <button onclick="cariLokasi()">🔍 Cari</button>
    </div>
</section>

<div class="map-container">
    <iframe id="map"
        src="https://maps.google.com/maps?q=Yogyakarta+Indonesia&t=&z=13&ie=UTF8&iwloc=&output=embed"
        allowfullscreen loading="lazy">
    </iframe>
</div>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>

<script src="toggle.js"></script>
<script>
function cariLokasi(){
    const lokasi = document.getElementById("lokasi").value.trim();
    if(!lokasi){ showToast("Masukkan lokasi dulu!", "error"); return; }
    document.getElementById("map").src =
        "https://maps.google.com/maps?q=" + encodeURIComponent(lokasi) + "&t=&z=14&ie=UTF8&iwloc=&output=embed";
}

document.getElementById("lokasi").addEventListener("keydown", function(e){
    if(e.key === "Enter") cariLokasi();
});
</script>
</body>
</html>
