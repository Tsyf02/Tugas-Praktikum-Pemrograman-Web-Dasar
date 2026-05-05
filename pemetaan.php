<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
?>
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
<a href="logout.php">Logout</a>
<a href="index.php">Beranda</a>
<a href="pendataan.php">Pendataan</a>
<a href="pemetaan.php">Pemetaan</a>
<a href="statistik.php">Statistik</a>
<a href="tentang.php">Tentang</a>
</nav>

</header>

<section class="hero">

<h1>
Pemetaan Lokasi Penduduk
</h1>

<p>
Halaman ini digunakan untuk melihat
persebaran lokasi penghuni kost dan kontrakan.
</p>

<div class="map-box">

<iframe
src="https://maps.google.com/maps?q=depok&t=&z=13&ie=UTF8&iwloc=&output=embed"
width="100%"
height="450"
style="border:0; border-radius:20px; margin-top:30px;">
</iframe>

</div>

</section>

<footer>
© 2026 Sistem Informasi Penduduk Non-Permanen
</footer>

</body>
</html>
