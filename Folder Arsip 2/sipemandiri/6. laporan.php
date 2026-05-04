<?=          //  -Perihal: Halaman Laporan & Statistik -
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$page_title = 'Laporan & Statistik';

include 'includes/header.php';
?>

<div class="breadcrumb fade-up">
    <a href="dashboard.php">🏠 Dashboard</a> <span>/</span> <span>Laporan & Statistik</span>
</div>

<div class="page-header fade-up fade-up-1">
    <div class="page-header-left">
        <h2>📊 Laporan & Statistik</h2>
        <p>Rekap data penduduk non-permanen secara lengkap dan terstruktur.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="cetak.php" class="btn btn-outline">🖨️ Cetak Laporan</a>
        <button class="btn btn-gold" onclick="exportExcel()">📥 Ekspor Excel</button>
    </div>
</div>

<!-- Filter -->
<div class="card fade-up fade-up-2" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 14px 18px;">
        <div class="toolbar">
            <label style="font-weight: 600; color: var(--gray-600); font-size: 0.85rem;">Filter Periode:</label>
            <select class="btn btn-outline" onchange="updateReports(this.value)">
                <option>Tahun 2024</option>
                <option>Tahun 2023</option>
                <option>Semester I 2024</option>
                <option>Semester II 2023</option>
            </select>
            <select class="btn btn-outline">
                <option>Semua RT</option>
                <option>RT 01</option><option>RT 02</option>
                <option>RT 03</option><option>RT 04</option>
                <option>RT 05</option><option>RT 06</option>
            </select>
            <button class="btn btn-primary">Tampilkan</button>
        </div>
    </div>
</div>

<!-- Summary Stats -->
<div class="stats-grid fade-up fade-up-2">
    <div class="stat-card blue">
        <div class="stat-icon blue">👥</div>
        <div class="stat-info">
            <div class="stat-value">142</div>
            <div class="stat-label">Total Penduduk Aktif</div>
            <div class="stat-trend up">▲ 8.4% dari tahun lalu</div>
        </div>
    </div>
    <div class="stat-card gold">
        <div class="stat-icon gold">📅</div>
        <div class="stat-info">
            <div class="stat-value">52</div>
            <div class="stat-label">Pendatang Tahun 2024</div>
            <div class="stat-trend up">▲ 12 orang baru</div>
        </div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green">📤</div>
        <div class="stat-info">
            <div class="stat-value">23</div>
            <div class="stat-label">Meninggalkan Wilayah</div>
            <div class="stat-trend down">▼ 3 lebih sedikit dari 2023</div>
        </div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon red">📋</div>
        <div class="stat-info">
            <div class="stat-value">29</div>
            <div class="stat-label">Pertumbuhan Bersih</div>
            <div class="stat-trend up">▲ Saldo positif</div>
        </div>
    </div>
</div>

<!-- Charts Row - WOW -->
<div class="grid-2 fade-up fade-up-3" style="margin-bottom: 20px;">
    <div class="card">
        <div class="card-header">
            <div class="card-title">📈 Tren Bulanan 2024</div>
        </div>
        <div class="card-body">
            <canvas id="lineChart" height="220"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">📊 Sebaran per RT</div>
        </div>
        <div class="card-body">
            <canvas id="barRT" height="220"></canvas>
        </div>
    </div>
</div>

<div class="grid-2 fade-up fade-up-4" style="margin-bottom: 20px;">
    <div class="card">
        <div class="card-header">
            <div class="card-title">🥧 Komposisi Jenis Kelamin</div>
        </div>
        <div class="card-body">
            <canvas id="pieJK" height="200"></canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">🎓 Komposisi Pekerjaan</div>
        </div>
        <div class="card-body">
            <canvas id="barPekerjaan" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Rekap Tabel per RT -->
<div class="card fade-up fade-up-4">
    <div class="card-header">
        <div class="card-title">🗂️ Rekap Data per RT</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>RT</th>
                    <th>Kost</th>
                    <th>Kontrak</th>
                    <th>Total</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Mahasiswa</th>
                    <th>Karyawan</th>
                    <th>Lainnya</th>
                </tr>
            </thead>
            <tbody>

              
                <?php
                $rekap = [
                    ['RT 01', 12, 9,  21, 11, 10, 8, 10, 3],
                    ['RT 02', 15, 8,  23, 13, 10, 12, 9, 2],
                    ['RT 03', 18, 11, 29, 16, 13, 14, 11, 4],
                    ['RT 04', 9,  7,  16, 9,  7,  7,  7, 2],
                    ['RT 05', 13, 5,  18, 10, 8,  9,  7, 2],
                    ['RT 06', 7,  28, 35, 18, 17, 14, 15, 6],
                ];
                $totals = array_fill(1, 8, 0);
                foreach ($rekap as $row):
                    for ($i = 1; $i <= 8; $i++) $totals[$i] += $row[$i];
                ?>
                <tr>
                    <td><strong><?php echo $row[0]; ?></strong></td>
                    <td><span class="badge badge-green"><?php echo $row[1]; ?></span></td>
                    <td><span class="badge badge-blue"><?php echo $row[2]; ?></span></td>
                    <td><strong><?php echo $row[3]; ?></strong></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[6]; ?></td>
                    <td><?php echo $row[7]; ?></td>
                    <td><?php echo $row[8]; ?></td>
                </tr>

              
                <?php endforeach; ?>
                <tr style="background: var(--gray-50); font-weight: 700;">
                    <td><strong>TOTAL</strong></td>
                    <td><span class="badge badge-green"><?php echo $totals[1]; ?></span></td>
                    <td><span class="badge badge-blue"><?php echo $totals[2]; ?></span></td>
                    <td><strong><?php echo $totals[3]; ?></strong></td>
                    <td><?php echo $totals[4]; ?></td>
                    <td><?php echo $totals[5]; ?></td>
                    <td><?php echo $totals[6]; ?></td>
                    <td><?php echo $totals[7]; ?></td>
                    <td><?php echo $totals[8]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php
$page_scripts = '
// Line chart — trend bulanan
new Chart(document.getElementById("lineChart").getContext("2d"), {
    type: "line",
    data: {
        labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Ags","Sep","Okt","Nov","Des"],
        datasets: [
            {
                label: "Masuk",
                data: [8,11,7,14,12,0,0,0,0,0,0,0],
                borderColor: "#1a3a7a",
                backgroundColor: "rgba(26,58,122,0.08)",
                tension: 0.4, fill: true, pointRadius: 5,
            },
            {
                label: "Keluar",
                data: [3,5,4,6,5,0,0,0,0,0,0,0],
                borderColor: "#e8a020",
                backgroundColor: "rgba(232,160,32,0.08)",
                tension: 0.4, fill: true, pointRadius: 5,
            }
        ]
    },
    options: { responsive: true, plugins: { legend: { position: "top" } }, scales: { y: { beginAtZero: true, grid: { color: "#eef0f6" } }, x: { grid: { display: false } } } }
});

// Bar chart — per RT
new Chart(document.getElementById("barRT").getContext("2d"), {
    type: "bar",
    data: {
        labels: ["RT 01","RT 02","RT 03","RT 04","RT 05","RT 06"],
        datasets: [
            { label: "Kost",    data: [12,15,18,9,13,7],  backgroundColor: "#17a36b", borderRadius: 5 },
            { label: "Kontrak", data: [9,8,11,7,5,28],    backgroundColor: "#1a3a7a", borderRadius: 5 },
        ]
    },
    options: { responsive: true, plugins: { legend: { position: "top" } }, scales: { x: { stacked: true }, y: { stacked: true, grid: { color: "#eef0f6" } } } }
});

// Pie JK
new Chart(document.getElementById("pieJK").getContext("2d"), {
    type: "doughnut",
    data: {
        labels: ["Laki-laki (77)", "Perempuan (65)"],
        datasets: [{ data: [77, 65], backgroundColor: ["#1a3a7a", "#e8a020"], borderWidth: 0, hoverOffset: 6 }]
    },
    options: { responsive: true, cutout: "60%", plugins: { legend: { position: "bottom" } } }
});

// Bar Pekerjaan
new Chart(document.getElementById("barPekerjaan").getContext("2d"), {
    type: "bar",
    data: {
        labels: ["Mahasiswa", "Karyawan Swasta", "Wiraswasta", "Guru/PNS", "Lainnya"],
        datasets: [{
            label: "Jumlah",
            data: [64, 44, 16, 10, 8],
            backgroundColor: ["#1a3a7a","#17a36b","#e8a020","#2979cc","#8a92aa"],
            borderRadius: 5,
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: "#eef0f6" } }, x: { grid: { display: false } } } }
});

function exportExcel() {
    alert("Fitur ekspor Excel akan diimplementasikan dengan library PhpSpreadsheet.");
}
function updateReports(period) {
    console.log("Reload charts for:", period);
}
';
include 'includes/footer.php';
?>
