<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }

$conn = mysqli_connect("localhost","root","","db_penduduk");
$uid  = (int)$_SESSION['user_id'];

// ---- Handle profile update ----
if(isset($_POST['update_profile'])){
    $nama  = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $bio   = mysqli_real_escape_string($conn, $_POST['bio'] ?? '');

    // Handle avatar upload
    $foto_sql = "";
    if(!empty($_FILES['foto']['name'])){
        $ext   = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allow = ['jpg','jpeg','png','gif','webp'];
        if(in_array($ext, $allow) && $_FILES['foto']['size'] < 2*1024*1024){
            $dir      = 'uploads/avatars/';
            if(!is_dir($dir)) mkdir($dir, 0755, true);
            $filename = 'avatar_' . $uid . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $filename);
            $foto_sql = ", foto='" . mysqli_real_escape_string($conn, $dir.$filename) . "'";
        }
    }

    // Handle password change
    $pass_sql = "";
    if(!empty($_POST['new_password'])){
        $old_pass = md5($_POST['old_password']);
        $cek = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM user WHERE id='$uid' AND password='$old_pass'"));
        if($cek > 0){
            $new_pass = md5($_POST['new_password']);
            $pass_sql = ", password='$new_pass'";
            $_SESSION['toast'] = ['msg'=>'Password berhasil diubah!','type'=>'success'];
        } else {
            $_SESSION['toast'] = ['msg'=>'Password lama salah!','type'=>'error'];
        }
    }

    mysqli_query($conn,
        "UPDATE user SET nama_lengkap='$nama', email='$email', bio='$bio' $foto_sql $pass_sql
         WHERE id='$uid'"
    );

    $_SESSION['nama'] = $nama;
    if(empty($_SESSION['toast'])){
        $_SESSION['toast'] = ['msg'=>'Profil berhasil diperbarui!','type'=>'success'];
    }
    header("Location: profil.php"); exit;
}

// ---- Fetch user data ----
$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM user WHERE id='$uid'"));
$foto = !empty($user['foto']) && file_exists($user['foto']) ? $user['foto'] : '';
$initials = strtoupper(substr($user['nama_lengkap'], 0, 2));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Profil — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
.profile-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 28px;
    border-bottom: 2px solid rgba(255,255,255,0.15);
    padding-bottom: 0;
}

.tab-btn {
    padding: 10px 22px;
    background: transparent;
    color: rgba(255,255,255,0.65);
    border: none;
    border-bottom: 3px solid transparent;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    transition: all 0.25s;
    margin-bottom: -2px;
}

.tab-btn:hover { color: white; }
.tab-btn.active { color: #38BDF8; border-bottom-color: #38BDF8; }

.tab-panel { display: none; }
.tab-panel.active { display: block; }

.avatar-preview-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
    margin-bottom: 28px;
}

#avatarPreview {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 4px solid #38BDF8;
    box-shadow: 0 0 0 6px rgba(56,189,248,0.2);
    overflow: hidden;
    background: linear-gradient(135deg, #0284C7, #38BDF8);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 46px;
    font-weight: 700;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

#avatarPreview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

#avatarPreview:hover { box-shadow: 0 0 0 8px rgba(56,189,248,0.3); }

.avatar-hint {
    font-size: 12px;
    color: rgba(255,255,255,0.55);
    text-align: center;
}

.password-strength {
    height: 4px;
    border-radius: 4px;
    background: #e2e8f0;
    margin-top: -10px;
    margin-bottom: 14px;
    overflow: hidden;
}

.strength-bar {
    height: 100%;
    width: 0%;
    border-radius: 4px;
    transition: width 0.3s, background 0.3s;
}
</style>
</head>
<body>

<header>
    <a class="navbar-brand" href="index.php">
        <img src="assets/images/LOGOUNGU.png" alt="Violet Restaurant Logo">
    </a>
    <nav>
        <?php if($_SESSION['role'] == 'admin'): ?>"},{
        <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>
        <?php endif; ?>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
        <a href="statistik.php" data-i18n="nav_statistik">Statistik</a>
        <a href="tentang.php" data-i18n="nav_tentang">Tentang</a>
        <a href="profil.php" class="active" data-i18n="nav_profil">Profil</a>
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

<div class="profile-section">

    <!-- Profile header card -->
    <div class="profile-card" style="margin-bottom: 28px;">
        <div class="profile-header">
            <div class="profile-avatar-wrap">
                <?php if($foto): ?>
                    <img src="<?= htmlspecialchars($foto); ?>" class="profile-avatar" alt="avatar">
                <?php else: ?>
                    <div class="profile-avatar-placeholder"><?= $initials; ?></div>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h2><?= htmlspecialchars($user['nama_lengkap']); ?></h2>
                <p>👤 @<?= htmlspecialchars($user['username']); ?></p>
                <p>📧 <?= htmlspecialchars($user['email'] ?? 'Belum diatur'); ?></p>
                <p>🏷️ 
                    <?php if($user['role'] === 'admin'): ?>
                        <span class="badge-admin">admin</span>
                    <?php else: ?>
                        <span class="badge-user">user</span>
                    <?php endif; ?>
                </p>
                <?php if(!empty($user['bio'])): ?>
                <p style="margin-top:8px;font-style:italic;color:rgba(255,255,255,0.7);">"<?= htmlspecialchars($user['bio']); ?>"</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="profile-card">
        <div class="profile-tabs">
            <button class="tab-btn active" onclick="switchTab('tab-info', this)">✏️ Edit Profil</button>
            <button class="tab-btn" onclick="switchTab('tab-password', this)">🔐 Ganti Password</button>
        </div>

        <!-- Tab: Edit Info -->
        <div class="tab-panel active" id="tab-info">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="update_profile" value="1">

                <!-- Avatar upload -->
                <div class="avatar-preview-wrap">
                    <div id="avatarPreview" onclick="document.getElementById('fotoInput').click()" title="Klik untuk ganti foto">
                        <?php if($foto): ?>
                            <img id="avatarImg" src="<?= htmlspecialchars($foto); ?>" alt="avatar">
                        <?php else: ?>
                            <span id="avatarInitials"><?= $initials; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="avatar-hint">Klik avatar untuk mengganti foto<br>Maks 2MB · JPG, PNG, WebP</div>
                    <input type="file" name="foto" id="fotoInput" accept="image/*" style="display:none" onchange="previewAvatar(this)">
                </div>

                <div class="profile-form-grid">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" value="<?= htmlspecialchars($user['username']); ?>" readonly style="opacity:0.6;cursor:not-allowed;">
                    </div>
                    <div class="form-group full-width">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? ''); ?>" placeholder="email@example.com">
                    </div>
                    <div class="form-group full-width">
                        <label>Bio / Deskripsi</label>
                        <textarea name="bio" rows="3" placeholder="Tulis sedikit tentang diri Anda..."><?= htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="profile-actions">
                    <button type="submit" class="btn" style="margin-top:0;">💾 Simpan Perubahan</button>
                    <a href="beranda.php"><button type="button" class="close">Batal</button></a>
                </div>
            </form>
        </div>

        <!-- Tab: Change Password -->
        <div class="tab-panel" id="tab-password">
            <form method="POST">
                <input type="hidden" name="update_profile" value="1">
                <!-- Carry over unchanged fields silently -->
                <input type="hidden" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']); ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($user['email'] ?? ''); ?>">
                <input type="hidden" name="bio" value="<?= htmlspecialchars($user['bio'] ?? ''); ?>">

                <div class="profile-form-grid">
                    <div class="form-group full-width">
                        <label>Password Lama</label>
                        <input type="password" name="old_password" placeholder="Masukkan password lama" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Password Baru</label>
                        <input type="password" name="new_password" id="newPassInput"
                               placeholder="Minimal 6 karakter"
                               oninput="checkStrength(this.value)" required>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_password" id="confirmPass"
                               placeholder="Ulangi password baru"
                               oninput="checkMatch()" required>
                        <small id="matchMsg" style="font-size:12px;margin-top:-10px;display:block;"></small>
                    </div>
                </div>

                <div class="profile-actions">
                    <button type="submit" class="btn" style="margin-top:0;" id="changePwBtn">🔐 Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>

<script src="toggle.js"></script>
<script>
// ---- Tabs ----
function switchTab(id, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    btn.classList.add('active');
}

// ---- Avatar preview ----
function previewAvatar(input) {
    if(input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = function(e){
            const wrap = document.getElementById('avatarPreview');
            wrap.innerHTML = '<img id="avatarImg" src="'+e.target.result+'" alt="preview" style="width:100%;height:100%;object-fit:cover;">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ---- Password strength ----
function checkStrength(val) {
    const bar = document.getElementById('strengthBar');
    let strength = 0;
    if(val.length >= 6) strength++;
    if(val.length >= 10) strength++;
    if(/[A-Z]/.test(val)) strength++;
    if(/[0-9]/.test(val)) strength++;
    if(/[^A-Za-z0-9]/.test(val)) strength++;
    const colors = ['','#ef4444','#f97316','#eab308','#22c55e','#16a34a'];
    const pct    = [0, 20, 40, 60, 80, 100];
    bar.style.width     = pct[strength] + '%';
    bar.style.background = colors[strength] || '#e2e8f0';
}

// ---- Confirm password match ----
function checkMatch() {
    const p1  = document.getElementById('newPassInput').value;
    const p2  = document.getElementById('confirmPass').value;
    const msg = document.getElementById('matchMsg');
    const btn = document.getElementById('changePwBtn');
    if(p2 === '') { msg.textContent = ''; return; }
    if(p1 === p2){
        msg.textContent = '✅ Password cocok';
        msg.style.color = '#22c55e';
        btn.disabled = false;
    } else {
        msg.textContent = '❌ Password tidak cocok';
        msg.style.color = '#ef4444';
        btn.disabled = true;
    }
}

// ---- Toast from session ----
<?php if(isset($_SESSION['toast'])): ?>
document.addEventListener('DOMContentLoaded', function(){
    showToast("<?= addslashes($_SESSION['toast']['msg']); ?>", "<?= $_SESSION['toast']['type']; ?>");
});
<?php unset($_SESSION['toast']); endif; ?>
</script>
</body>
</html>
