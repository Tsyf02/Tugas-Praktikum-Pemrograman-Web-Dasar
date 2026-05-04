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

$_SESSION['login'] = true;

echo "
<script>
alert('Login berhasil');
document.location='index.php';
</script>
";

}else{

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
<title>Login</title>

<link rel="stylesheet" href="style.css">

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

</body>
</html>