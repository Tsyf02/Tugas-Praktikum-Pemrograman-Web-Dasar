<?= // peta.php — Halaman Peta Sebaran Penduduk Non-Permanen
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$page_title = 'Peta Sebaran';
$use_map    = true; // Load Leaflet CSS/JS

// Dummy marker data (replace with DB queries) 
$markers = [
    // Rumah Kost
    ['lat' => -7.7956, 'lng' => 110.3695, 'nama' => 'Kost Bu Sari',      'jenis' => 'kost',    'penghuni' => 8, 'rt' => 'RT 01', 'alamat' => 'Jl. Magelang No. 12'],
    ['lat' => -7.7980, 'lng' => 110.3710, 'nama' => 'Kost Pak Joko',     'jenis' => 'kost',    'penghuni' => 5, 'rt' => 'RT 02', 'alamat' => 'Jl. Monjali No. 5A'],
    ['lat' => -7.7930, 'lng' => 110.3675, 'nama' => 'Kost Mawar Indah',  'jenis' => 'kost',    'penghuni' => 12, 'rt' => 'RT 03', 'alamat' => 'Jl. Palagan Km. 3'],
    ['lat' => -7.8010, 'lng' => 110.3690, 'nama' => 'Kost Melati',       'jenis' => 'kost',    'penghuni' => 6, 'rt' => 'RT 04', 'alamat' => 'Jl. Kaliurang No. 88'],
    ['lat' => -7.7960, 'lng' => 110.3730, 'nama' => 'Kost Cemara',       'jenis' => 'kost',    'penghuni' => 9, 'rt' => 'RT 05', 'alamat' => 'Jl. Ring Road Utara'],
    ['lat' => -7.7940, 'lng' => 110.3720, 'nama' => 'Kost Nusa Indah',   'jenis' => 'kost',    'penghuni' => 7, 'rt' => 'RT 05', 'alamat' => 'Jl. Lingkar No. 14'],

    // Rumah Kontrak
    ['lat' => -7.7970, 'lng' => 110.3650, 'nama' => 'Kontrak Jl. Merpati', 'jenis' => 'kontrak', 'penghuni' => 4, 'rt' => 'RT 01', 'alamat' => 'Jl. Merpati No. 3'],
    ['lat' => -7.7990, 'lng' => 110.3680, 'nama' => 'Kontrak Pak Ahmad',   'jenis' => 'kontrak', 'penghuni' => 3, 'rt' => 'RT 02', 'alamat' => 'Jl. Demak Ijo No. 9'],
    ['lat' => -7.7920, 'lng' => 110.3700, 'nama' => 'Kontrak Bu Rina',     'jenis' => 'kontrak', 'penghuni' => 5, 'rt' => 'RT 03', 'alamat' => 'Jl. Godean Km. 5'],
    ['lat' => -7.8000, 'lng' => 110.3660, 'nama' => 'Kontrak Flamboyan',   'jenis' => 'kontrak', 'penghuni' => 6, 'rt' => 'RT 06', 'alamat' => 'Jl. Flamboyan No. 21'],
    ['lat' => -7.7950, 'lng' => 110.3665, 'nama' => 'Kontrak Permata',     'jenis' => 'kontrak', 'penghuni' => 4, 'rt' => 'RT 04', 'alamat' => 'Jl. Permata No. 7'],
];

include 'includes/header.php';
?>

<div class="breadcrumb fade-up">
    <a href="dashboard.php">🏠 Dashboard</a> <span>/</span> <span>Peta Sebaran</span>
</div>

<div class="page-header fade-up fade-up-1">
    <div class="page-header-left">
        <h2>🗺️ Peta Sebaran Penduduk</h2>
        <p>Visualisasi lokasi rumah kost dan rumah kontrak dalam satu peta interaktif.</p>
    </div>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <select class="btn btn-outline" id="filterRT" onchange="filterMarkers()">
            <option value="all">Semua RT</option>
            <option value="RT 01">RT 01</option>
            <option value="RT 02">RT 02</option>
            <option value="RT 03">RT 03</option>
            <option value="RT 04">RT 04</option>
            <option value="RT 05">RT 05</option>
            <option value="RT 06">RT 06</option>
        </select>
        <select class="btn btn-outline" id="filterJenis" onchange="filterMarkers()">
            <option value="all">Semua Jenis</option>
            <option value="kost">Rumah Kost</option>
            <option value="kontrak">Rumah Kontrak</option>
        </select>
    </div>
</div>

<!-- Stat mini row -->
<div class="stats-grid fade-up fade-up-2" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 20px;">
    <div class="stat-card blue" style="padding: 14px 18px;">
        <div class="stat-icon blue" style="width:38px; height:38px; font-size: 1.1rem;">📍</div>
        <div class="stat-info">
            <div class="stat-value" style="font-size: 1.4rem;"><?php echo count($markers); ?></div>
            <div class="stat-label">Total Titik Lokasi</div>
        </div>
    </div>
    <div class="stat-card green" style="padding: 14px 18px;">
        <div class="stat-icon green" style="width:38px; height:38px; font-size: 1.1rem;">🛏️</div>
        <div class="stat-info">
            <div class="stat-value" style="font-size: 1.4rem;"><?php echo count(array_filter($markers, fn($m) => $m['jenis'] === 'kost')); ?></div>
            <div class="stat-label">Rumah Kost</div>
        </div>
    </div>
    <div class="stat-card blue" style="padding: 14px 18px;">
        <div class="stat-icon blue" style="width:38px; height:38px; font-size: 1.1rem;">🏠</div>
        <div class="stat-info">
            <div class="stat-value" style="font-size: 1.4rem;"><?php echo count(array_filter($markers, fn($m) => $m['jenis'] === 'kontrak')); ?></div>
            <div class="stat-label">Rumah Kontrak</div>
        </div>
    </div>
    <div class="stat-card gold" style="padding: 14px 18px;">
        <div class="stat-icon gold" style="width:38px; height:38px; font-size: 1.1rem;">👥</div>
        <div class="stat-info">
            <div class="stat-value" style="font-size: 1.4rem;"><?php echo array_sum(array_column($markers, 'penghuni')); ?></div>
            <div class="stat-label">Total Penghuni Terpetakan</div>
        </div>
    </div>
</div>

<!-- Map + Legend Layout -->
<div class="grid-main-side fade-up fade-up-3">

    <!-- MAP -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">📍 Peta Interaktif</div>
            <div style="display: flex; gap: 8px;">
                <button class="btn btn-outline btn-sm" onclick="map.setView([-7.7970, 110.3690], 15)">
                    🏠 Reset Tampilan
                </button>
                <a href="tambah.php" class="btn btn-gold btn-sm">+ Tambah Titik</a>
            </div>
        </div>
        <div style="padding: 16px;">
            <div id="map"></div>
        </div>
    </div>

    <!-- SIDEBAR: Legend + List -->
    <div style="display: flex; flex-direction: column; gap: 18px;">

        <!-- Legend -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">🔍 Keterangan</div>
            </div>
            <div class="card-body">
                <div class="map-legend">
                    <div class="legend-item">
                        <div class="legend-dot" style="background: #17a36b;"></div>
                        <span>Rumah Kost</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background: #1a3a7a;"></div>
                        <span>Rumah Kontrak</span>
                    </div>
                </div>
                <div class="divider"></div>
                <p style="font-size: 0.8rem; color: var(--gray-400); line-height: 1.6;">
                    Klik pada marker untuk melihat detail lokasi dan jumlah penghuni.
                    Gunakan scroll untuk zoom in/out.
                </p>
            </div>
        </div>

        <!-- Location list -->
        <div class="card" style="flex: 1;">
            <div class="card-header">
                <div class="card-title">📋 Daftar Lokasi</div>
            </div>
            <div style="max-height: 350px; overflow-y: auto;">
                <?php foreach ($markers as $i => $m): ?>
                <div
                    class="profile-detail-row"
                    style="cursor: pointer; transition: background 0.15s;"
                    onclick="flyToMarker(<?php echo $i; ?>)"
                    onmouseover="this.style.background='var(--gray-50)'"
                    onmouseout="this.style.background=''"
                >
                    <div style="font-size: 1.2rem;"><?php echo $m['jenis'] === 'kost' ? '🛏️' : '🏠'; ?></div>
                    <div>
                        <strong style="font-size: 0.85rem; display: block;"><?php echo htmlspecialchars($m['nama']); ?></strong>
                        <span style="font-size: 0.75rem; color: var(--gray-400);">
                            <?php echo $m['rt']; ?> &bull; <?php echo $m['penghuni']; ?> penghuni
                        </span>
                    </div>
                    <span class="badge <?php echo $m['jenis'] === 'kost' ? 'badge-green' : 'badge-blue'; ?>" style="margin-left: auto; font-size: 0.65rem;">
                        <?php echo ucfirst($m['jenis']); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
$page_scripts = '
// ---- Marker data from PHP ----
const markerData = ' . json_encode($markers) . ';

// Init Leaflet Map
const map = L.map("map").setView([-7.7970, 110.3690], 15);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors",
    maxZoom: 19
}).addTo(map);

// Custom icons
function makeIcon(color) {
    return L.divIcon({
        className: "",
        html: `<div style="
            width: 32px; height: 32px;
            background: ${color};
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.25);
        "></div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -36]
    });
}

const kostIcon    = makeIcon("#17a36b");
const kontrakIcon = makeIcon("#1a3a7a");

// Create markers
const leafletMarkers = [];

markerData.forEach(function(m, i) {
    const icon   = m.jenis === "kost" ? kostIcon : kontrakIcon;
    const emoji  = m.jenis === "kost" ? "🛏️" : "🏠";
    const badge  = m.jenis === "kost"
        ? "<span style=\"background:#e0f5ed; color:#0f7a50; padding:2px 8px; border-radius:99px; font-size:11px; font-weight:700;\">Kost</span>"
        : "<span style=\"background:#e8eefa; color:#1a3a7a; padding:2px 8px; border-radius:99px; font-size:11px; font-weight:700;\">Kontrak</span>";

    const popup = `
        <div style="font-family: DM Sans, sans-serif; min-width: 200px;">
            <div style="font-weight: 800; font-size: 1rem; margin-bottom: 4px;">${emoji} ${m.nama}</div>
            <div style="margin-bottom: 8px;">${badge}</div>
            <table style="font-size: 12px; width: 100%; border-collapse: collapse;">
                <tr><td style="color:#8a92aa; padding: 2px 0; width: 80px;">RT</td><td style="font-weight: 600;">${m.rt}</td></tr>
                <tr><td style="color:#8a92aa; padding: 2px 0;">Alamat</td><td style="font-weight: 600;">${m.alamat}</td></tr>
                <tr><td style="color:#8a92aa; padding: 2px 0;">Penghuni</td><td style="font-weight: 600;">${m.penghuni} orang</td></tr>
            </table>
            <a href="detail.php?nama=${encodeURIComponent(m.nama)}"
               style="display:block; margin-top: 10px; text-align: center; background: #0f2554; color: white;
                      padding: 6px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none;">
               Lihat Detail
            </a>
        </div>
    `;

    const marker = L.marker([m.lat, m.lng], { icon })
        .bindPopup(popup)
        .addTo(map);

    marker._rawData = m;
    leafletMarkers.push(marker);
});

// Fly to marker
function flyToMarker(index) {
    const m = markerData[index];
    map.flyTo([m.lat, m.lng], 17, { animate: true, duration: 1 });
    setTimeout(() => leafletMarkers[index].openPopup(), 900);
}

// Filter markers 
function filterMarkers() {
    const rt    = document.getElementById("filterRT").value;
    const jenis = document.getElementById("filterJenis").value;

    leafletMarkers.forEach(function(marker, i) {
        const d = marker._rawData;
        const matchRT    = rt    === "all" || d.rt    === rt;
        const matchJenis = jenis === "all" || d.jenis === jenis;

        if (matchRT && matchJenis) {
            if (!map.hasLayer(marker)) map.addLayer(marker);
        } else {
            if (map.hasLayer(marker)) map.removeLayer(marker);
        }
    });
}
';
include 'includes/footer.php';
?>
