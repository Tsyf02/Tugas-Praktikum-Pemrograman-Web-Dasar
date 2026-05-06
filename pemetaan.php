<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pemetaan Lokasi</title>

<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* SEARCH */
.search-box{
text-align:center;
margin-top:20px;
}

.search-box input{
width:60%;
max-width:500px;
padding:12px;
border-radius:10px;
border:none;
font-size:16px;
}

.search-box button{
padding:12px 20px;
border:none;
border-radius:10px;
background:#0284C7;
color:white;
cursor:pointer;
font-size:16px;
transition:0.3s;
}

.search-box button:hover{
background:#0369A1;
}

/* MAP */
.map-container{
margin:40px auto;
width:90%;
max-width:1000px;
}

.map-container iframe{
width:100%;
height:450px;
border-radius:20px;
border:none;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
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
<a href="tentang.php">Tentang</a>
<a href="statistik.php">Statistik</a>

</nav>

</header>

<!-- HERO -->
<section class="hero">

<h1>
Pemetaan Lokasi Penduduk
</h1>

<p>
Cari lokasi kost atau kontrakan berdasarkan alamat secara langsung
</p>

</section>

<!-- SEARCH -->
<div class="search-box">

<input
type="text"
id="lokasi"
placeholder="Contoh: Depok, Kost dekat kampus..."
>

<button onclick="cariLokasi()">
Cari
</button>

</div>

<!-- MAP -->
<div class="map-container">

<iframe
id="map"
src="https://maps.google.com/maps?q=indonesia&t=&z=13&ie=UTF8&iwloc=&output=embed">
</iframe>

</div>

<footer>
© 2026 Sistem Informasi Penduduk Non-Permanen
</footer>

<script>

function cariLokasi(){

let lokasi = document.getElementById("lokasi").value;

if(lokasi == ""){
alert("Masukkan lokasi dulu!");
return;
}

let url = "https://maps.google.com/maps?q=" + lokasi + "&t=&z=13&ie=UTF8&iwloc=&output=embed";

document.getElementById("map").src = url;

}

</script>

</body>
</html>
