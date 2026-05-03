<?php
//dari file index.php // ini nantinya sebagai login nya
session_start();

// "Redirect" jika kondisi "already logged in"
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Handle login - form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Demo credentials (in production: query from database)
    $valid_users = [
        'admin'    => ['password' => 'admin123',   'name' => 'Admin Desa',     'role' => 'Administrator'],
        'petugas'  => ['password' => 'petugas123',  'name' => 'Petugas Desa',  'role' => 'Petugas Lapangan'],
        'pimpinan' => ['password' => 'pimpinan123', 'name' => 'Kepala Desa',   'role' => 'Pimpinan'],
    ];

    if (isset($valid_users[$username]) && $valid_users[$username]['password'] === $password) {
        $_SESSION['user'] = [
            'username' => $username,
            'name'     => $valid_users[$username]['name'],
            'role'     => $valid_users[$username]['role'],
        ];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah. Silakan coba lagi.';
    }
}
?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Talitha Syifa Al Fath_124250173 & Marva H._124250159">    
  <meta name="description" content="SIPemandiri - Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen (Kontrak & Kost) Berbasis Web"> 
  <title>Masuk — SIPEMANDIRI</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🗺️</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: var(--gray-50);">

<div class="login-page">

    <!-- Visual Panel (kiri) -->
    <div class="login-visual">
        <div>
            <div class="login-visual-badge">
                🏛️ &nbsp; Sistem Informasi Pemerintah Desa
            </div>
            <h2>Pemetaan Data<br>Penduduk <em>Non-Permanen</em><br>Secara Digital</h2>
            <p>
                Kelola dan pantau data penduduk sementara — penghuni kost
                dan rumah kontrak — dalam satu platform terintegrasi
                berbasis peta interaktif.
            </p>
        </div>

        <div class="login-visual-stats">
            <div class="login-stat">
                <div class="login-stat-val">142</div>
                <div class="login-stat-lbl">Total Penduduk Terdaftar</div>
            </div>
            <div class="login-stat">
                <div class="login-stat-val">28</div>
                <div class="login-stat-lbl">Lokasi Kost & Kontrak</div>
            </div>
            <div class="login-stat">
                <div class="login-stat-val">6</div>
                <div class="login-stat-lbl">RT / Lingkungan</div>
            </div>
        </div>
    </div>

    <!-- Login Panel (Kanan) -->
    <div class="login-panel">
        <div class="login-form-box">

            <div class="login-logo">
                <div class="login-logo-icon">🗺️</div>
                <div>
                    <h1>SIPEMANDIRI</h1>
                    <p>Sistem Informasi Pemetaan Penduduk Non-Permanen</p>
                </div>
            </div>

            <div class="login-heading">
                <h3>Selamat Datang 👋</h3>
                <p>Masuk dengan akun yang telah diberikan oleh administrator.</p>
            </div>

            <?php if ($error): ?>
            <div class="alert alert-danger fade-up">
                <i class="fa fa-circle-exclamation"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="index.php">
                <div class="form-group fade-up fade-up-1">
                    <label for="username">Username <span class="required">*</span></label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username Anda"
                        value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                        autocomplete="username"
                        required
                    >
                </div>

                <div class="form-group fade-up fade-up-2" style="margin-bottom: 8px;">
                    <label for="password">Password <span class="required">*</span></label>
                    <div class="input-eye-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password Anda"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="eye-btn" id="togglePwd" title="Tampilkan password">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="login-actions fade-up fade-up-3">
                    <label class="check-label">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    <a href="#" class="login-link">Lupa password?</a>
                </div>

                <button type="submit" class="login-submit fade-up fade-up-4">
                    <i class="fa fa-arrow-right-to-bracket"></i> &nbsp; Masuk ke Sistem
                </button>

                <p class="login-footer-note">
                    🔒 Sistem ini hanya untuk petugas berwenang.<br>
                    Hubungi administrator jika mengalami kendala akses.
                </p>
            </form>

            <!-- Demo credentials hint -->
            <div style="margin-top: 24px; padding: 14px; background: #f0f4ff; border-radius: 8px; border: 1px solid #cdd9f5;">
                <p style="font-size: 0.75rem; color: #3a5aa0; font-weight: 600; margin-bottom: 6px;">📋 Akun Demo:</p>
                <p style="font-size: 0.75rem; color: #4a6090; line-height: 1.6;">
                    admin / admin123 &nbsp;|&nbsp; petugas / petugas123<br>
                    pimpinan / pimpinan123
                </p>
            </div>
        </div>
    </div>

</div>

<script>
    // Toggle password (visibility)
    document.getElementById('togglePwd').addEventListener('click', function() {
        const pwd  = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.className = 'fa fa-eye-slash';
        } else {
            pwd.type = 'password';
            icon.className = 'fa fa-eye';
        }
    });
</script>

</body>
</html>
