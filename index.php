<?php
session_start();

if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;
}
?>
<?php
$conn = mysqli_connect("localhost","root","","db_penduduk");
if(isset($_GET['hapus'])){

$id = $_GET['hapus'];

mysqli_query($conn,"
DELETE FROM penduduk
WHERE id='$id'
");

echo "
<script>
alert('Data berhasil dihapus');
document.location='index.php';
</script>
";

}

if(isset($_POST['update'])){

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$nohp = $_POST['nohp'];
$jenis = $_POST['jenis'];

mysqli_query($conn,"
UPDATE penduduk SET

nama='$nama',
alamat='$alamat',
nohp='$nohp',
jenis='$jenis'

WHERE id='$id'

");

echo "
<script>
alert('Data berhasil diupdate');
document.location='index.php';
</script>
";

}

if(isset($_POST['simpan'])){

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$nohp = $_POST['nohp'];
$jenis = $_POST['jenis'];

mysqli_query($conn,"
INSERT INTO penduduk
VALUES(
'',
'$nama',
'$alamat',
'$nohp',
'$jenis'
)
");

echo "
<script>
alert('Data berhasil ditambahkan');
document.location='index.php';
</script>
";

}

$data = mysqli_query($conn,"
SELECT * FROM penduduk
");

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:
linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)),
url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=1974&auto=format&fit=crop');
background-size:cover;
background-attachment:fixed;
color:white;
}

header{
background:#0F172A;
padding:20px 40px;
display:flex;
justify-content:space-between;
align-items:center;
position:sticky;
top:0;
z-index:1000;
box-shadow:0 4px 20px rgba(0,0,0,0.4);
}

.logo{
font-size:25px;
font-weight:700;
}

nav a{
color:white;
text-decoration:none;
margin-left:25px;
font-weight:500;
transition:0.3s;
}

nav a:hover{
color:#38BDF8;
}

.hero{
padding:100px 30px;
text-align:center;
}

.hero h1{
font-size:50px;
line-height:1.3;
margin-bottom:20px;
}

.hero p{
max-width:850px;
margin:auto;
font-size:18px;
line-height:1.8;
}

.btn{
margin-top:35px;
padding:15px 35px;
background:#0284C7;
border:none;
border-radius:12px;
color:white;
font-size:17px;
font-weight:600;
cursor:pointer;
transition:0.3s;
}

.btn:hover{
background:#0369A1;
transform:translateY(-3px);
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:25px;
padding:40px;
}

.card{
background:rgba(255,255,255,0.12);
backdrop-filter:blur(10px);
padding:30px;
border-radius:20px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
transition:0.3s;
}

.card:hover{
transform:translateY(-10px);
}

.card h2{
font-size:42px;
margin-bottom:10px;
}

.card p{
font-size:18px;
}

.container{
padding:40px;
}

.table-box{
background:white;
padding:30px;
border-radius:20px;
overflow:auto;
box-shadow:0 10px 30px rgba(0,0,0,0.4);
}

.table-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
flex-wrap:wrap;
gap:15px;
}

.table-header h2{
color:#0F172A;
}

.add-btn{
padding:12px 20px;
background:#0284C7;
color:white;
border:none;
border-radius:10px;
cursor:pointer;
font-weight:600;
}

table{
width:100%;
border-collapse:collapse;
}

table th{
background:#0F172A;
color:white;
padding:15px;
font-size:15px;
}

table td{
padding:14px;
border-bottom:1px solid #ddd;
color:#333;
}

table tr:hover{
background:#F1F5F9;
}

.status{
padding:7px 15px;
border-radius:30px;
font-size:13px;
font-weight:600;
}

.kost{
background:#DBEAFE;
color:#1D4ED8;
}

.kontrak{
background:#DCFCE7;
color:#166534;
}

.edit{
background:#2563EB;
color:white;
border:none;
padding:8px 14px;
border-radius:8px;
cursor:pointer;
margin-right:5px;
}

.delete{
background:#DC2626;
color:white;
border:none;
padding:8px 14px;
border-radius:8px;
cursor:pointer;
}

.modal{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.6);
display:none;
justify-content:center;
align-items:center;
z-index:999;
}

.modal-content{
background:white;
width:90%;
max-width:500px;
padding:30px;
border-radius:20px;
}

.modal-content h2{
color:#0F172A;
margin-bottom:20px;
}

.modal-content input,
.modal-content select{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:10px;
}

.save{
background:#0284C7;
color:white;
border:none;
padding:12px 20px;
border-radius:10px;
cursor:pointer;
font-weight:600;
}

.close{
background:#DC2626;
color:white;
border:none;
padding:12px 20px;
border-radius:10px;
cursor:pointer;
font-weight:600;
margin-left:10px;
}

/* FOOTER */

footer{
background:#0F172A;
padding:25px;
text-align:center;
margin-top:40px;
}

@media(max-width:768px){

.hero h1{
font-size:35px;
}

header{
padding:20px;
flex-direction:column;
gap:15px;
}

}

</style>

</head>
<body>

<header>

<div class="logo">
📍 SiMap Kost & Kontrak
</div>

<nav>
<a href="logout.php">Logout</a>
<a href="index.php">
Beranda
</a>
<a href="pendataan.php">
Pendataan
</a>
<a href="pemetaan.php">
Pemetaan
</a>
<a href="tentang.php">
Tentang
</a>
</nav>

</header>

<section class="hero">

<h1>
Sistem Informasi Pemetaan Lokasi & <br>
Data Mandiri Penduduk Non-Permanen <br>
(Kontrak & Kost) Berbasis Web
</h1>

<p>
Sistem digital modern untuk membantu pendataan lokasi tempat tinggal
penduduk non-permanen seperti penghuni kost dan rumah kontrakan secara
cepat, akurat, dan terintegrasi berbasis web.
</p>

<button class="btn" onclick="openModal()">
+ Tambah Data Penduduk
</button>

</section>

<section class="cards">

<div class="card">
<h2 id="total">4</h2>
<p>Total Penduduk</p>
</div>

<div class="card">
<h2>2</h2>
<p>Penghuni Kost</p>
</div>

<div class="card">
<h2>2</h2>
<p>Penghuni Kontrak</p>
</div>

<div class="card">
<h2>8</h2>
<p>Total Lokasi</p>
</div>

</section>

<section class="container">

<div class="table-box">

<div class="table-header">

<h2>Data Penduduk Non-Permanen</h2>

<button class="add-btn" onclick="openModal()">
+ Tambah Data
</button>

</div>

<table>

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>No HP</th>
<th>Jenis Tinggal</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody id="tableBody">

<?php
$no = 1;

while($row = mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['alamat']; ?></td>

<td><?= $row['nohp']; ?></td>

<td><?= $row['jenis']; ?></td>

<td>

<span class="status <?= strtolower($row['jenis']); ?>">
<?= $row['jenis']; ?>
</span>

</td>

<td>

<button
class="edit"

onclick="editData(
'<?= $row['id']; ?>',
'<?= $row['nama']; ?>',
'<?= $row['alamat']; ?>',
'<?= $row['nohp']; ?>',
'<?= $row['jenis']; ?>'
)"

>

Edit

</button>

<a href="?hapus=<?= $row['id']; ?>">

<button
class="delete"
onclick="return confirm('Yakin ingin menghapus data ini?')">

Hapus

</button>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</section>

<!-- MODAL -->

<div class="modal" id="modal">

<div class="modal-content">

<h2>Tambah Data Penduduk</h2>

<form method="POST">

<input
type="hidden"
name="id"
id="id">

<input type="text" name="nama" placeholder="Nama Lengkap" required>

<input type="text" name="alamat" placeholder="Alamat Tinggal" required>

<input type="text" name="nohp" placeholder="Nomor HP" required>

<select name="jenis">

<option value="Kost">Kost</option>
<option value="Kontrak">Kontrak</option>

</select>

<button type="submit" class="save" id="btnSubmit">
Simpan
</button>

<button
type="submit"
name="update"
class="save"
id="btnUpdate"
style="display:none;">

Update

</button>

<button type="button" class="close" onclick="closeModal()">
Tutup
</button>

</form>

</div>

</div>

<footer>
© 2026 Sistem Informasi Penduduk Non-Permanen Berbasis Web
</footer>

<script>

function openModal(){
document.getElementById("modal").style.display="flex";
}

function closeModal(){
document.getElementById("modal").style.display="none";
}

</script>

</body>
</html>

<?php

if(isset($_POST['nama'])){

$id     = $_POST['id'];
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$nohp   = $_POST['nohp'];
$jenis  = $_POST['jenis'];

if($id == ""){

// TAMBAH DATA
mysqli_query($conn,"
INSERT INTO penduduk
VALUES(
'',
'$nama',
'$alamat',
'$nohp',
'$jenis'
)
");

echo "
<script>
alert('Data berhasil ditambahkan');
document.location='pendataan.php';
</script>
";

}else{

// UPDATE DATA
mysqli_query($conn,"
UPDATE penduduk SET
nama='$nama',
alamat='$alamat',
nohp='$nohp',
jenis='$jenis'
WHERE id='$id'
");

echo "
<script>
alert('Data berhasil diupdate');
document.location='pendataan.php';
</script>
";

}

}
?>


?>
<script>

function editData(id,nama,alamat,nohp,jenis){

document.getElementById("modal").style.display="flex";

document.getElementById("id").value = id;
document.getElementById("nama").value = nama;
document.getElementById("alamat").value = alamat;
document.getElementById("nohp").value = nohp;
document.getElementById("jenis").value = jenis;

document.getElementById("btnSubmit").innerText = "Update";

}

function openModal(){

document.getElementById("modal").style.display="flex";

document.getElementById("id").value = "";
document.getElementById("nama").value = "";
document.getElementById("alamat").value = "";
document.getElementById("nohp").value = "";
document.getElementById("jenis").value = "Kost";

document.getElementById("btnSubmit").innerText = "Simpan";

}

</script>