<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="author" content="Talitha Syifa Al Fath_124250173 & Marva H._124250159">    
<meta name="description" content="SIPemandiri - Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen (Kontrak & Kost) Berbasis Web"> 
<title>SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/x-icon"> 
<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
<header>

<div class="logo">
📍 SIPeManDiRi
</div>

<nav>
    
     <?php if($_SESSION['role'] == 'admin'): ?>   
    <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>    
    <?php endif; ?>                        
    <a href="logout.php" data-i18n="nav_logout">Logout</a>
    <a href="index.php" data-i18n="nav_beranda">Beranda</a>
    <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
    <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
    <a href="statistik.php" data-i18n="nav_statistik">Statistik</a>
    <a href="tentang.php" data-i18n="nav_tentang">Tentang</a>         
</nav>

<div class="toggle-container">
    <!-- Dark Mode Toggle -->
    <label class="toggle-switch">
        <input type="checkbox" id="darkModeToggle" onchange="toggleDarkMode()">
        <span class="toggle-slider"></span>
    </label>
    <span class="toggle-label">
        <span id="darkModeIcon">☀️</span>
        <span id="darkModeText">Light</span>
    </span>
    
    <!-- Language Toggle -->
    <label class="toggle-switch" style="margin-left: 10px;">
        <input type="checkbox" id="langToggle" onchange="toggleLanguage()">
        <span class="toggle-slider"></span>
    </label>
    <span class="toggle-label">
        <span id="langIcon">🇮🇩</span>
        <span id="langText">ID</span>
    </span>
</div>

</header>

<section class="hero">

<h1>
Sistem Informasi Pemetaan Lokasi & <br>
Data Mandiri Penduduk Non-Permanen <br>
(Kontrak & Kost) Berbasis Web
</h1>

<p>
Website modern berbasis PHP dan MySQL untuk membantu
pendataan masyarakat non-permanen seperti penghuni
kost dan rumah kontrakan secara digital.
</p>

<a href="pendataan.php">
<button class="btn">
Mulai Pendataan
</button>
</a>

</section>

<section class="cards">

<div class="card">
<h2>120</h2>
<p>Total Penduduk</p>
</div>

<div class="card">
<h2>65</h2>
<p>Penghuni Kost</p>
</div>

<div class="card">
<h2>55</h2>
<p>Penghuni Kontrak</p>
</div>

<div class="card">
<h2>15</h2>
<p>Total Lokasi</p>
</div>

</section>

<footer>
© 2026 Sistem Informasi Penduduk Non-Permanen
</footer>

</body>
</html>
