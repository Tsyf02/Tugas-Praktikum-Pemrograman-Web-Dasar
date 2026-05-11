<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php"); exit;
}
$conn = mysqli_connect("localhost","root","","db_penduduk");

if(isset($_GET['hapus'])){
    $id = (int)$_GET['hapus'];
    if($id != $_SESSION['user_id']){
        mysqli_query($conn,"DELETE FROM user WHERE id='$id'");
        $_SESSION['toast'] = ['msg'=>'User berhasil dihapus','type'=>'success'];
    } else {
        $_SESSION['toast'] = ['msg'=>'Tidak bisa menghapus akun sendiri!','type'=>'error'];
    }
    header("Location: manage_user.php"); exit;
}

$users = mysqli_query($conn,"SELECT * FROM user ORDER BY role DESC, nama_lengkap ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Kelola User — SIPeManDiRi</title>
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
        <a href="manage_user.php" class="active" data-i18n="nav_kelola_user">Kelola User</a>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
        <a href="statistik.php" data-i18n="nav_statistik">Statistik</a>
        <a href="profil.php" data-i18n="nav_profil">Profil</a>
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

<section class="container">
    <div class="table-box">
        <div class="table-header">
            <h2 data-i18n="manage_title">Daftar Akun User</h2>
            <a href="register.php"><button class="add-btn" data-i18n="nav_tambah_user">+ Tambah User</button></a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <div class="user-cell">
                        <?php
                        // Show profile photo if exists, otherwise initials
                        $photo = !empty($row['foto']) ? $row['foto'] : '';
                        $initials = strtoupper(substr($row['nama_lengkap'], 0, 1));
                        if($photo && file_exists($photo)):
                        ?>
                            <img src="<?= htmlspecialchars($photo); ?>" class="user-avatar-sm" alt="foto">
                        <?php else: ?>
                            <div class="user-initials"><?= $initials; ?></div>
                        <?php endif; ?>
                        <span><?= htmlspecialchars($row['nama_lengkap']); ?></span>
                    </div>
                </td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td>
                    <!-- FIX: proper badge with text, not just color dot -->
                    <?php if($row['role'] === 'admin'): ?>
                        <span class="badge-admin">admin</span>
                    <?php else: ?>
                        <span class="badge-user">user</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($row['id'] != $_SESSION['user_id']): ?>
                    <a href="?hapus=<?= $row['id']; ?>"
                       onclick="return confirm('Hapus user <?= htmlspecialchars($row['username']); ?>?')">
                        <button class="btn-delete">Hapus</button>
                    </a>
                    <?php else: ?>
                        <span style="color:#94A3B8;font-size:13px;">(Anda)</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>

<script src="toggle.js"></script>
<script>
<?php if(isset($_SESSION['toast'])): ?>
document.addEventListener('DOMContentLoaded', function(){
    showToast("<?= $_SESSION['toast']['msg']; ?>", "<?= $_SESSION['toast']['type']; ?>");
});
<?php unset($_SESSION['toast']); endif; ?>
</script>
</body>
</html>
