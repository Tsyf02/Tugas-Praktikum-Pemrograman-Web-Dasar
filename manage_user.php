<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost","root","","db_penduduk");

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    // Jangan sampai admin hapus dirinya sendiri
    if($id != $_SESSION['user_id']){
        mysqli_query($conn,"DELETE FROM user WHERE id='$id'");
        echo "<script>alert('User dihapus'); document.location='manage_user.php';</script>";
    } else {
        echo "<script>alert('Tidak bisa menghapus akun sendiri!'); document.location='manage_user.php';</script>";
    }
}

$users = mysqli_query($conn,"SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">📍 SIPeManDiRi</div>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="register.php">+ Tambah User</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="container">
    <div class="table-box">
        <div class="table-header">
            <h2>Daftar Akun User</h2>
            <a href="register.php"><button class="add-btn">+ Tambah User</button></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th><th>Nama Lengkap</th><th>Username</th><th>Role</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; while($row=mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td><?= $row['username']; ?></td>
                <td>
                    <span style="padding:5px 12px;border-radius:20px;font-size:13px;font-weight:600;
                                 background:<?= $row['role']=='admin' ? '#DBEAFE' : '#DCFCE7'; ?>;
                                 color:<?= $row['role']=='admin' ? '#1D4ED8' : '#166534'; ?>;">
                        <?= $row['role']; ?>
                    </span>
                </td>
                <td>
                    <a href="?hapus=<?= $row['id']; ?>" 
                       onclick="return confirm('Hapus user <?= $row['username']; ?>?')">
                        <button style="background:#DC2626;color:white;border:none;padding:8px 14px;
                                       border-radius:8px;cursor:pointer;">Hapus</button>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
