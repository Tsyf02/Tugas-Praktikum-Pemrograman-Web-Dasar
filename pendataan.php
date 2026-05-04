<?php

$conn = mysqli_connect("localhost","root","","db_penduduk");

$data = mysqli_query($conn,"SELECT * FROM penduduk");

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pendataan</title>

<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<header>

<div class="logo">
📍 SiMap Kost & Kontrak
</div>

<nav>
<a href="index.php">Beranda</a>
<a href="pendataan.php">Pendataan</a>
<a href="pemetaan.php">Pemetaan</a>
<a href="statistik.php">Statistik</a>
<a href="tentang.php">Tentang</a>
</nav>

</header>

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
</tr>

</thead>

<tbody>

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

<input type="text" name="nama" placeholder="Nama Lengkap" required>

<input type="text" name="alamat" placeholder="Alamat" required>

<input type="text" name="nohp" placeholder="Nomor HP" required>

<select name="jenis">

<option value="Kost">
Kost
</option>

<option value="Kontrak">
Kontrak
</option>

</select>

<button type="submit" name="simpan" class="save">
Simpan
</button>

<button type="button" class="close" onclick="closeModal()">
Tutup
</button>

</form>

</div>

</div>

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

document.location='pendataan.php';

</script>

";

}

?>
