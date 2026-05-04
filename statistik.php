<?php
session_start();
$conn = mysqli_connect("localhost","root","","db_penduduk");

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as jumlah FROM penduduk
"))['jumlah'];

$kost = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as jumlah FROM penduduk WHERE jenis='Kost'
"))['jumlah'];

$kontrak = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as jumlah FROM penduduk WHERE jenis='Kontrak'
"))['jumlah'];
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Statistik</title>

<link rel="stylesheet" href="style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

/* CONTAINER */
.stat-container{
max-width:1000px;
margin:40px auto;
padding:0 20px;
}

/* CARD KECIL */
.stat-cards{
display:flex;
justify-content:center;
gap:20px;
flex-wrap:wrap;
margin-bottom:30px;
}

.stat-card{
background:rgba(255,255,255,0.1);
backdrop-filter:blur(10px);
padding:20px 25px;
border-radius:15px;
text-align:center;
width:200px;
box-shadow:0 5px 15px rgba(0,0,0,0.3);
transition:0.3s;
}

.stat-card:hover{
transform:translateY(-5px);
}

.stat-card h2{
font-size:28px;
margin-bottom:5px;
}

.stat-card p{
font-size:14px;
}

/* GRAFIK */
.chart-box{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.3);
}

.chart-box h3{
color:#0F172A;
margin-bottom:15px;
text-align:center;
}

/* RESPONSIVE */
@media(max-width:768px){
.stat-card{
width:100%;
}
}

</style>

</head>
<body>

<header>

<div class="logo">
📊 Statistik
</div>

<nav>
<a href="index.php">Beranda</a>
<a href="pendataan.php">Pendataan</a>
<a href="pemetaan.php">Pemetaan</a>
<a href="statistik.php">Statistik</a>
<a href="tentang.php">Tentang</a>
</nav>

</header>

<div class="stat-container">

<!-- CARD -->
<div class="stat-cards">

<div class="stat-card">
<h2><?= $total; ?></h2>
<p>Total Penduduk</p>
</div>

<div class="stat-card">
<h2><?= $kost; ?></h2>
<p>Kost</p>
</div>

<div class="stat-card">
<h2><?= $kontrak; ?></h2>
<p>Kontrak</p>
</div>

</div>

<!-- GRAFIK -->
<div class="chart-box">

<h3>Perbandingan Data Penduduk</h3>

<canvas id="myChart" height="120"></canvas>

</div>

</div>

<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {
type: 'bar',
data: {
labels: ['Kost', 'Kontrak'],
datasets: [{
label: 'Jumlah',
data: [<?= $kost; ?>, <?= $kontrak; ?>],
borderWidth: 1
}]
},
options: {
plugins: {
legend: {
display: false
}
},
scales: {
y: {
beginAtZero: true
}
}
}
});

</script>

<footer>
© 2026 Sistem Informasi Penduduk
</footer>

</body>
</html>
