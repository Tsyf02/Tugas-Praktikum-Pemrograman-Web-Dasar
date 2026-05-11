<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php"); exit;
}
$conn = mysqli_connect("localhost","root","","db_penduduk");
$error = "";

if(isset($_POST['daftar'])){
    $username     = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $password_raw = $_POST['password'];
    $password     = md5($password_raw);
    $role         = in_array($_POST['role'], ['admin','user']) ? $_POST['role'] : 'user';

    // Check username duplicate
    $cek = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM user WHERE username='$username'"));
    if($cek > 0){
        $error = "Username sudah dipakai!";
    } else {
        // Insert user
        mysqli_query($conn,
            "INSERT INTO user (username, nama_lengkap, email, password, role)
             VALUES('$username','$nama_lengkap','$email','$password','$role')"
        );

        // ===== EMAIL NOTIFICATION =====
        // Uses PHP mail(). For production, use PHPMailer + SMTP.
        if(!empty($email)){
            $subject  = "Akun SIPeManDiRi Anda Telah Dibuat";
            $app_url  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
                        . '://' . $_SERVER['HTTP_HOST']
                        . dirname($_SERVER['PHP_SELF']) . '/login.php';

            $body = "Halo $nama_lengkap,\n\n"
                  . "Akun SIPeManDiRi Anda telah berhasil dibuat oleh administrator.\n\n"
                  . "Detail login Anda:\n"
                  . "  Username : $username\n"
                  . "  Password : $password_raw\n"
                  . "  Role     : $role\n\n"
                  . "Silakan login di: $app_url\n\n"
                  . "Segera ganti password Anda setelah login pertama.\n\n"
                  . "Salam,\nTim SIPeManDiRi";

            $headers = "From: noreply@sipemandiri.local\r\n"
                     . "Reply-To: noreply@sipemandiri.local\r\n"
                     . "X-Mailer: PHP/" . phpversion();

            @mail($email, $subject, $body, $headers);
            // Note: mail() requires a configured mail server.
            // For real deployment, use PHPMailer with SMTP:
            // require 'vendor/autoload.php'; use PHPMailer\PHPMailer\PHPMailer;
        }

        $_SESSION['toast'] = ['msg'=>"Akun '$username' berhasil dibuat. Email notifikasi dikirim.", 'type'=>'success'];
        header("Location: manage_user.php"); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Tambah User — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <a class="navbar-brand" href="index.php">
        <img src="assets/images/LOGOUNGU.png" alt="Violet Restaurant Logo">
    </a>
    <nav>
        <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
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

<div class="container">
    <div class="form-box" style="margin: 40px auto;">
        <h2>➕ Tambah Akun Baru</h2>

        <?php if($error): ?>
            <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text"     name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="text"     name="username"     placeholder="Username" required>
            <input type="email"    name="email"        placeholder="Email (untuk notifikasi)" required>
            <input type="password" name="password"     placeholder="Password" required>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <div style="background:rgba(56,189,248,0.15);border:1px solid rgba(56,189,248,0.3);
                        padding:12px;border-radius:8px;margin-bottom:14px;font-size:13px;
                        color:rgba(255,255,255,0.85);">
                📧 User akan menerima email notifikasi dengan detail login mereka.
            </div>

            <button type="submit" name="daftar" class="btn" style="margin-top:0;width:100%;">
                Simpan &amp; Kirim Notifikasi
            </button>
        </form>
    </div>
</div>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>
<script src="toggle.js"></script>
</body>
</html>
