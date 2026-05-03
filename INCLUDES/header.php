<?=
// To Shared navigation header for all Page ok

// Determine active page
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Active nav penolong/ helper
function is_active($page) {
    global $current_page;
    return $current_page === $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' — SIPEMANDIRI' : 'SIPEMANDIRI'; ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🗺️</text></svg>">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <!-- Leaflet CSS (loaded on map pages) -->
    <?php if (isset($use_map) && $use_map): ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <?php endif; ?>
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="layout">

<!-- ======================== SIDEBAR ======================== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon">🗺️</div>
        <div class="sidebar-logo-text">
            <h1>SIPEMANDIRI</h1>
            <p>Pemetaan Penduduk<br>Non-Permanen</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Menu Utama</div>

        <a href="dashboard.php" class="nav-item <?php echo is_active('dashboard'); ?>">
            <span class="nav-icon">🏠</span>
            <span>Dashboard</span>
        </a>

        <a href="peta.php" class="nav-item <?php echo is_active('peta'); ?>">
            <span class="nav-icon">🗺️</span>
            <span>Peta Sebaran</span>
        </a>

        <div class="sidebar-section-label">Data Penduduk</div>

        <a href="data.php" class="nav-item <?php echo is_active('data'); ?>">
            <span class="nav-icon">👥</span>
            <span>Data Penduduk</span>
            <span class="nav-badge">142</span>
        </a>

        <a href="tambah.php" class="nav-item <?php echo is_active('tambah'); ?>">
            <span class="nav-icon">➕</span>
            <span>Tambah Data</span>
        </a>

        <a href="kontrak.php" class="nav-item <?php echo is_active('kontrak'); ?>">
            <span class="nav-icon">🏠</span>
            <span>Rumah Kontrak</span>
        </a>

        <a href="kost.php" class="nav-item <?php echo is_active('kost'); ?>">
            <span class="nav-icon">🛏️</span>
            <span>Rumah Kost</span>
        </a>

        <div class="sidebar-section-label">Laporan</div>

        <a href="laporan.php" class="nav-item <?php echo is_active('laporan'); ?>">
            <span class="nav-icon">📊</span>
            <span>Laporan & Statistik</span>
        </a>

        <a href="cetak.php" class="nav-item <?php echo is_active('cetak'); ?>">
            <span class="nav-icon">🖨️</span>
            <span>Cetak Data</span>
        </a>

        <div class="sidebar-section-label">Sistem</div>

        <a href="pengguna.php" class="nav-item <?php echo is_active('pengguna'); ?>">
            <span class="nav-icon">⚙️</span>
            <span>Kelola Pengguna</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="index.php" class="nav-item" onclick="return confirm('Yakin ingin keluar?')">
            <span class="nav-icon">🚪</span>
            <span>Keluar</span>
        </a>
    </div>
</aside>

<!-- ======================== CLASS:  MAIN WRAP ======================== -->
<div class="main-wrap">

    <!-- Topbar -->
    <header class="topbar">
        <button class="topbar-btn" id="sidebarToggle" title="Toggle Sidebar">
            <i class="fa fa-bars"></i>
        </button>

        <div class="topbar-title">
            <?php echo isset($page_title) ? $page_title : 'Dashboard'; ?>
            <?php if (isset($page_subtitle)): ?>
                <span> — <?php echo $page_subtitle; ?></span>
            <?php endif; ?>
        </div>

        <div class="topbar-actions">
            <button class="topbar-btn" title="Notifikasi">
                <i class="fa fa-bell"></i>
                <span class="badge"></span>
            </button>
            <button class="topbar-btn" title="Pengaturan">
                <i class="fa fa-cog"></i>
            </button>
            <a href="pengguna.php" class="topbar-user">
                <div class="topbar-avatar">AD</div>
                <div class="topbar-user-info">
                    <strong>Admin Desa</strong>
                    <span>Administrator</span>
                </div>
            </a>
        </div>
    </header>

    <!-- Main Content/ UTAMMA -->
    <main class="main-content">
