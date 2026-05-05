<?php
session_start();
$conn = mysqli_connect("localhost","root","","db_penduduk");

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($conn,"
SELECT * FROM user
WHERE username='$username'
AND password='$password'
");

$cek = mysqli_num_rows($data);

if($cek > 0){
    $user = mysqli_fetch_assoc($data);
    $_SESSION['login']    = true;
    $_SESSION['role']     = $user['role'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id']  = $user['id'];

    echo "
    <script>
    alert('Login berhasil');
    document.location='index.php';
    </script>
    ";
}else{
            // menambahkan user untuk login selain untuk admin
echo "
<script>
alert('Username / Password salah');
</script>
";

}

}
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
<style>

.login-box{
width:350px;
margin:120px auto;
background:rgba(255,255,255,0.1);
padding:30px;
border-radius:20px;
backdrop-filter:blur(10px);
text-align:center;
}

.login-box h2{
margin-bottom:20px;
}

.login-box input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:10px;
border:none;
}

.login-box button{
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:#0284C7;
color:white;
font-weight:bold;
cursor:pointer;
}

</style>


</head>
<body>
<header>

<div class="logo">
📍 SIPeManDiRi
</div>

<nav>
    <!-- aku nambah daftar akun biar bisa nambah user   -->
<a href="manage_user.php">Daftar Akun</a>  
<a href="index.php">Beranda</a>
<a href="pendataan.php">Pendataan</a>
<a href="pemetaan.php">Pemetaan</a>
<a href="statistik.php">Statistik</a>
<a href="tentang.php">Tentang</a>
</nav>

</header>

<div class="login-box">

<h2>Login Admin</h2>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">
Login
</button>

</form>

</div>

<footer>
© 2026 Sistem Informasi Penduduk Non-Permanen
</footer>
</body>
</html>
