<?=
session_start();
// Hanya admin yang boleh mendaftarkan user baru
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost","root","","db_penduduk");

if(isset($_POST['daftar'])){
    $username     = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password     = md5($_POST['password']);
    $role         = $_POST['role'];

    // Cek username sudah ada atau belum yah:)
    $cek = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user WHERE username='$username'"));
    if($cek > 0){
        $error = "Username sudah dipakai!";
    } else {
        mysqli_query($conn,"INSERT INTO user (username,nama_lengkap,password,role) 
                            VALUES('$username','$nama_lengkap','$password','$role')");
        echo "<script>alert('Akun berhasil dibuat'); document.location='manage_user.php';</script>";
        exit;
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
    <title>Daftar Akun</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
        body{background:linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)),url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=1974&auto=format&fit=crop');background-size:cover;background-attachment:fixed;color:white;}
        header{background:#0F172A;padding:20px 40px;display:flex;justify-content:space-between;align-items:center;}
        .logo{font-size:25px;font-weight:700;}
        nav a{color:white;text-decoration:none;margin-left:25px;font-weight:500;}
        nav a:hover{color:#38BDF8;}
        .form-box{max-width:500px;margin:60px auto;background:rgba(255,255,255,0.1);padding:30px;border-radius:20px;backdrop-filter:blur(10px);}
        .form-box h2{margin-bottom:20px;}
        .form-box input,.form-box select{width:100%;padding:12px;margin-bottom:12px;border-radius:10px;border:none;}
        .btn{width:100%;padding:12px;background:#0284C7;color:white;border:none;border-radius:10px;font-weight:bold;cursor:pointer;}
        .error{background:#DC2626;padding:10px;border-radius:8px;margin-bottom:15px;text-align:center;}
    </style>
</head>
<body>
<header>
    <div class="logo">📍 SIPeManDiRi</div>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="manage_user.php">Kelola User</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="form-box">
    <h2>Tambah Akun Baru</h2>
    <?php if(isset($error)): ?>
        <div class="error"><?= $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" name="daftar" class="btn">Simpan Akun</button>
    </form>
</div>
</body>
</html>
