<?= // dashboard.php — Halaman Utama / Dashboard
session_start();
// Redirect to login if not authenticated
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$page_title    = 'Dashboard';
$page_subtitle = 'Ringkasan Data';

// ---- Dummy statistics data (replace with real DB queries) ----
$stats = [
    'total_penduduk' => 142,
    'total_kontrak'  => 68,
    'total_kost'     => 74,
    'total_lokasi'   => 28,
    'masuk_bulan_ini'=> 12,
    'keluar_bulan_ini' => 5,
];

// Recent registrations dummy data
$recent_data = [
    ['id' => 'SP-2024-0142', 'nama' => 'Budi Santoso',     'nik' => '3474XXXXXXXX0001', 'jenis' => 'Kost',    'rt' => 'RT 03', 'tgl' => '2 Mei 2024',   'status' => 'Aktif'],
    ['id' => 'SP-2024-0141', 'nama' => 'Siti Rahayu',      'nik' => '3474XXXXXXXX0002', 'jenis' => 'Kontrak', 'rt' => 'RT 01', 'tgl' => '1 Mei 2024',   'status' => 'Aktif'],
    ['id' => 'SP-2024-0140', 'nama' => 'Ahmad Fauzi',      'nik' => '3474XXXXXXXX0003', 'jenis' => 'Kost',    'rt' => 'RT 05', 'tgl' => '30 Apr 2024',  'status' => 'Aktif'],
    ['id' => 'SP-2024-0139', 'nama' => 'Dewi Anggraini',   'nik' => '3474XXXXXXXX0004', 'jenis' => 'Kontrak', 'rt' => 'RT 02', 'tgl' => '28 Apr 2024',  'status' => 'Aktif'],
    ['id' => 'SP-2024-0138', 'nama' => 'Rizki Pratama',    'nik' => '3474XXXXXXXX0005', 'jenis' => 'Kost',    'rt' => 'RT 04', 'tgl' => '25 Apr 2024',  'status' => 'Nonaktif'],
];

// Monthly trend data (for chart)
$monthly_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
$monthly_masuk  = [8, 11, 7, 14, 12, 0, 0, 0, 0, 0, 0, 0];
$monthly_keluar = [3, 5,  4,  6,  5, 0, 0, 0, 0, 0, 0, 0];

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<div class="breadcrumb fade-up">
    <span>🏠</span>
    <span>Dashboard</span>
</div>

<div class="page-header fade-up fade-up-1">
    <div class="page-header-left">
        <h2>Dashboard</h2>
        <p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong>!
           Berikut ringkasan data penduduk non-permanen.</p>
    </div>
    <div>
        <a href="tambah.php" class="btn btn-gold">
            ➕ &nbsp; Tambah Data Baru
        </a>
    </div>
</div>

<!-- ===== STAT CARDS ===== -->
<div class="stats-grid fade-up fade-up-2">
    <div class="stat-card blue">
        <div class="stat-icon blue">👥</div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['total_penduduk']; ?></div>
            <div class="stat-label">Total Penduduk Terdaftar</div>
            <div class="stat-trend up">▲ <?php echo $stats['masuk_bulan_ini']; ?> pendatang baru bulan ini</div>
        </div>
    </div>

    <div class="stat-card gold">
        <div class="stat-icon gold">🏠</div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['total_kontrak']; ?></div>
            <div class="stat-label">Penghuni Rumah Kontrak</div>
            <div class="stat-trend up">▲ 4 bertambah bulan ini</div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon green">🛏️</div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['total_kost']; ?></div>
            <div class="stat-label">Penghuni Kost</div>
            <div class="stat-trend up">▲ 8 bertambah bulan ini</div>
        </div>
    </div>

    <div class="stat-card red">
        <div class="stat-icon red">📍</div>
        <div class="stat-info">
            <div class="stat-value"><?php echo $stats['total_lokasi']; ?></div>
            <div class="stat-label">Titik Lokasi Terpetakan</div>
            <div class="stat-trend up">▲ 3 lokasi baru</div>
        </div>
    </div>
</div>

<!-- ===== CHARTS + RECENT ===== -->
<div class="grid-main-side fade-up fade-up-3">

    <!-- Chart -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">📈 Tren Penduduk Masuk & Keluar (2024)</div>
            <div>
                <select class="btn btn-outline btn-sm" style="padding: 5px 10px;" onchange="updateChart(this.value)">
                    <option value="2024">Tahun 2024</option>
                    <option value="2023">Tahun 2023</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <canvas id="trendChart" height="220"></canvas>
        </div>
    </div>

    <!-- Sidebar widgets -->
    <div style="display: flex; flex-direction: column; gap: 18px;">

        <!-- Komposisi -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">🥧 Komposisi Hunian</div>
            </div>
            <div class="card-body" style="padding: 16px;">
                <canvas id="pieChart" height="180"></canvas>
            </div>
        </div>

        <!-- Quick links -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">⚡ Aksi Cepat</div>
            </div>
            <div style="padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                <a href="tambah.php" class="btn btn-primary btn-sm" style="justify-content: flex-start;">
                    ➕ &nbsp; Tambah Penduduk Baru
                </a>
                <a href="peta.php" class="btn btn-outline btn-sm" style="justify-content: flex-start;">
                    🗺️ &nbsp; Lihat Peta Sebaran
                </a>
                <a href="laporan.php" class="btn btn-outline btn-sm" style="justify-content: flex-start;">
                    📊 &nbsp; Ekspor Laporan
                </a>
                <a href="cetak.php" class="btn btn-outline btn-sm" style="justify-content: flex-start;">
                    🖨️ &nbsp; Cetak Data
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ===== RECENT TABLE ===== -->
<div class="card fade-up fade-up-4" style="margin-top: 20px;">
    <div class="card-header">
        <div class="card-title">🕐 Pendaftaran Terbaru</div>
        <a href="data.php" class="btn btn-outline btn-sm">Lihat Semua →</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Penduduk</th>
                    <th>NIK</th>
                    <th>Jenis Hunian</th>
                    <th>RT</th>
                    <th>Tgl Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_data as $row): ?>
                <tr>
                    <td><code style="font-size: 0.78rem; color: var(--navy-light);"><?php echo $row['id']; ?></code></td>
                    <td class="td-name">
                        <strong><?php echo htmlspecialchars($row['nama']); ?></strong>
                    </td>
                    <td style="font-size: 0.8rem; color: var(--gray-400);"><?php echo $row['nik']; ?></td>
                    <td>
                        <span class="badge <?php echo $row['jenis'] === 'Kost' ? 'badge-green' : 'badge-blue'; ?>">
                            <?php echo $row['jenis'] === 'Kost' ? '🛏️' : '🏠'; ?>
                            <?php echo $row['jenis']; ?>
                        </span>
                    </td>
                    <td><?php echo $row['rt']; ?></td>
                    <td style="font-size: 0.82rem; color: var(--gray-400);"><?php echo $row['tgl']; ?></td>
                    <td>
                        <span class="badge <?php echo $row['status'] === 'Aktif' ? 'badge-green' : 'badge-gray'; ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="detail.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-outline btn-sm">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$page_scripts = '
const months  = ' . json_encode($monthly_labels) . ';
const masuk   = ' . json_encode($monthly_masuk) . ';
const keluar  = ' . json_encode($monthly_keluar) . ';

// Bar chart — trend
const ctxBar = document.getElementById("trendChart").getContext("2d");
const trendChart = new Chart(ctxBar, {
    type: "bar",
    data: {
        labels: months,
        datasets: [
            {
                label: "Penduduk Masuk",
                data: masuk,
                backgroundColor: "#1a3a7a",
                borderRadius: 5,
            },
            {
                label: "Penduduk Keluar",
                data: keluar,
                backgroundColor: "#f5c05a",
                borderRadius: 5,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: "top" } },
        scales: {
            y: { beginAtZero: true, grid: { color: "#eef0f6" } },
            x: { grid: { display: false } }
        }
    }
});

// Pie chart — komposisi
const ctxPie = document.getElementById("pieChart").getContext("2d");
new Chart(ctxPie, {
    type: "doughnut",
    data: {
        labels: ["Kost (74)", "Kontrak (68)"],
        datasets: [{
            data: [74, 68],
            backgroundColor: ["#17a36b", "#1a3a7a"],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        cutout: "65%",
        plugins: { legend: { position: "bottom" } }
    }
});

function updateChart(year) {
    // Placeholder for fetching year-specific data
    console.log("Fetch data for year:", year);
}
';
include 'includes/footer.php';
?>
