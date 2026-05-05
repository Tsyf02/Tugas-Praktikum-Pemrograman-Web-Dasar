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

<style>

.about-section{
padding:80px 40px;
}

.about-container{
max-width:1200px;
margin:auto;
}

.about-title{
text-align:center;
margin-bottom:60px;
}

.about-title h1{
font-size:50px;
margin-bottom:20px;
}

.about-title p{
font-size:18px;
line-height:1.8;
max-width:850px;
margin:auto;
}

.about-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
gap:30px;
margin-top:40px;
}

.about-card{
background:rgba(255,255,255,0.12);
backdrop-filter:blur(10px);
padding:35px;
border-radius:25px;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
transition:0.3s;
}

.about-card:hover{
transform:translateY(-10px);
}

.about-card h2{
font-size:28px;
margin-bottom:15px;
}

.about-card p{
line-height:1.8;
font-size:16px;
}

.team-section{
margin-top:80px;
}

.team-title{
text-align:center;
margin-bottom:40px;
}

.team-title h1{
font-size:45px;
}

.team-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:25px;
}

.team-card{
background:rgba(255,255,255,0.12);
padding:30px;
border-radius:25px;
text-align:center;
backdrop-filter:blur(10px);
transition:0.3s;
}

.team-card:hover{
transform:scale(1.05);
}

.team-card img{
width:120px;
height:120px;
border-radius:50%;
margin-bottom:20px;
border:4px solid white;
object-fit:cover;
}

.team-card h2{
margin-bottom:10px;
}

.team-card p{
font-size:15px;
line-height:1.7;
}

.info-box{
margin-top:80px;
background:rgba(255,255,255,0.12);
padding:40px;
border-radius:25px;
backdrop-filter:blur(10px);
box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.info-box h1{
margin-bottom:20px;
font-size:40px;
}

.info-box p{
line-height:1.9;
font-size:17px;
}

@media(max-width:768px){

.about-title h1{
font-size:35px;
}

.team-title h1{
font-size:35px;
}

.info-box h1{
font-size:30px;
}

}

</style>

</head>
<body>

<header>

<div class="logo">
📍 SIPeManDiRi
</div>

<nav>

<a href="index.php">Beranda</a>
<a href="pendataan.php">Pendataan</a>
<a href="pemetaan.php">Pemetaan</a>
<a href="statistik.php">Statistik</a>
<a href="tentang.php">Tentang</a>

</nav>

</header>

<section class="about-section">

<div class="about-container">

<div class="about-title">

<h1>
Tentang Sistem Informasi
</h1>

<p>
"Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen
dibuat untuk membantu proses pendataan penghuni kost dan rumah kontrakan
secara digital, modern, cepat, dan lebih terintegrasi berbasis web."
</p>

</div>

<div class="about-grid">

<div class="about-card">
<center>
<h2>
Tujuan Sistem
<br> 📌 </br>
</h2>

<p>
Membantu pemerintah daerah maupun lingkungan RT/RW dalam melakukan
pendataan penduduk non-permanen secara lebih efektif dan terstruktur.
</p>
</center>
</div>

<div class="about-card">
<center>
<h2>
Teknologi
 <br>🌐 </br>
</h2>

<p>
Website ini dibangun menggunakan PHP, MySQL, HTML, CSS, dan JavaScript
dengan tampilan modern serta mudah digunakan.
</p>
</center>
</div>

<div class="about-card">
<center>
<h2>

Fitur Sistem
<br>📊</br>
</h2>

<p>
Sistem memiliki fitur pendataan penghuni, pemetaan lokasi tempat tinggal,
penyimpanan database, dan manajemen informasi penduduk.
</p>
</center>
</div>

</div>

<div class="team-section">

<div class="team-title">

<h1>
Tim Pengembang
</h1>

<h2>
Rasya  Marva Hervian 
</h2>

<h2>
Syifa Al Fath Talitha
</h2>



<div class="info-box">

<h1>
📍 Informasi Tambahan📍 
</h1>

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

© 2026 Sistem Informasi Penduduk Non-Permanen Berbasis Web

</footer>

</body>
</html>
