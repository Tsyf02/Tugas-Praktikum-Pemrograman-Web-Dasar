<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }

$conn = mysqli_connect("localhost","root","","db_penduduk");
$total   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk"))['j'];
$kost    = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk WHERE jenis='Kost'"))['j'];
$kontrak = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk WHERE jenis='Kontrak'"))['j'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Statistik — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
        <a href="statistik.php" class="active" data-i18n="nav_statistik">Statistik</a>
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

<div class="stat-container">
    <div class="stat-cards">
        <div class="stat-card"><h2><?= $total; ?></h2><p>Total Penduduk</p></div>
        <div class="stat-card"><h2><?= $kost; ?></h2><p>Kost</p></div>
        <div class="stat-card"><h2><?= $kontrak; ?></h2><p>Kontrak</p></div>
    </div>

    <div class="chart-box">
        <h3 data-i18n="stat_chart_title">Perbandingan Data Penduduk</h3>
        <canvas id="barChart" height="110"></canvas>
    </div>

    <div class="chart-box" style="margin-top:24px;">
        <h3>Distribusi Jenis Tempat Tinggal</h3>
        <div style="max-width:350px;margin:auto;">
            <canvas id="pieChart"></canvas>
        </div>
    </div>
</div>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>

<script src="toggle.js"></script>
<script>
const kost    = <?= $kost; ?>;
const kontrak = <?= $kontrak; ?>;

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['Kost', 'Kontrak'],
        datasets: [{
            label: 'Jumlah Penduduk',
            data: [kost, kontrak],
            backgroundColor: ['rgba(2,132,199,0.7)', 'rgba(22,163,74,0.7)'],
            borderColor:     ['#0284C7', '#16A34A'],
            borderWidth: 2,
            borderRadius: 8
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['Kost', 'Kontrak'],
        datasets: [{
            data: [kost, kontrak],
            backgroundColor: ['rgba(2,132,199,0.8)', 'rgba(22,163,74,0.8)'],
            borderColor: ['#0284C7','#16A34A'],
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});
</script>
</body>
</html>
