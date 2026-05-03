<?= 
// "Halaman Cetak Data"
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$page_title = 'Cetak Data';

// Dummy data (replace with DB)
$data_cetak = [
    ['No'=>1,'ID'=>'SP-2024-0142','Nama'=>'Budi Santoso',    'NIK'=>'3474010101900001','JK'=>'L','Asal'=>'Magelang',   'Jenis'=>'Kost',    'RT'=>'RT 03','Status'=>'Aktif'],
    ['No'=>2,'ID'=>'SP-2024-0141','Nama'=>'Siti Rahayu',     'NIK'=>'3474015505950002','JK'=>'P','Asal'=>'Bantul',     'Jenis'=>'Kontrak', 'RT'=>'RT 01','Status'=>'Aktif'],
    ['No'=>3,'ID'=>'SP-2024-0140','Nama'=>'Ahmad Fauzi',     'NIK'=>'3474012203920003','JK'=>'L','Asal'=>'Klaten',     'Jenis'=>'Kost',    'RT'=>'RT 05','Status'=>'Aktif'],
    ['No'=>4,'ID'=>'SP-2024-0139','Nama'=>'Dewi Anggraini',  'NIK'=>'3474011010980004','JK'=>'P','Asal'=>'Purworejo',  'Jenis'=>'Kontrak', 'RT'=>'RT 02','Status'=>'Aktif'],
    ['No'=>5,'ID'=>'SP-2024-0138','Nama'=>'Rizki Pratama',   'NIK'=>'3474010808960005','JK'=>'L','Asal'=>'Kulon Progo','Jenis'=>'Kost',    'RT'=>'RT 04','Status'=>'Nonaktif'],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data — SIPEMANDIRI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f5f5f5; font-size: 13px; }

        .no-print {
            background: #0f2554; color: white; padding: 12px 24px;
            display: flex; align-items: center; gap: 16px;
        }

        .no-print h1 { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1rem; font-weight: 800; }
        .no-print p { font-size: 0.78rem; opacity: 0.7; }
        .no-print button {
            margin-left: auto; background: #e8a020; color: #0f2554;
            border: none; padding: 8px 20px; border-radius: 6px;
            font-weight: 700; cursor: pointer; font-size: 0.85rem;
        }
        .no-print a {
            color: rgba(255,255,255,0.7); font-size: 0.82rem; text-decoration: none;
            border: 1px solid rgba(255,255,255,0.3); padding: 7px 14px; border-radius: 6px;
        }

        .print-page {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: white;
            padding: 20mm 18mm;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }

        .kop-surat {
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 3px solid #0f2554;
            padding-bottom: 12px;
            margin-bottom: 10px;
        }

        .kop-logo {
            width: 64px; height: 64px;
            border: 2px solid #0f2554;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
        }

        .kop-text { flex: 1; text-align: center; }
        .kop-text h1 { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .kop-text h2 { font-size: 0.9rem; font-weight: 600; }
        .kop-text p  { font-size: 0.75rem; color: #555; }

        .doc-title {
            text-align: center;
            margin: 16px 0 12px;
        }
        .doc-title h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1rem; font-weight: 800;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .doc-title p { font-size: 0.78rem; color: #555; margin-top: 4px; }

        .meta-table { width: 100%; margin-bottom: 14px; font-size: 0.8rem; }
        .meta-table td { padding: 2px 4px; }
        .meta-table td:first-child { width: 120px; font-weight: 600; }

        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.78rem; }
        table.data-table th {
            background: #0f2554; color: white;
            padding: 7px 8px; text-align: left;
            font-weight: 700; font-size: 0.72rem;
        }
        table.data-table td { padding: 6px 8px; border-bottom: 1px solid #e0e0e0; }
        table.data-table tr:nth-child(even) td { background: #f8f9fc; }

        .sign-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 36px;
        }
        .sign-box { text-align: center; }
        .sign-box p { font-size: 0.8rem; }
        .sign-box .sign-name {
            margin-top: 60px;
            font-weight: 700;
            text-decoration: underline;
        }
        .sign-box .sign-role { font-size: 0.75rem; color: #555; }

        .footer-note {
            margin-top: 24px;
            border-top: 1px solid #ccc;
            padding-top: 8px;
            font-size: 0.72rem; color: #888;
        }

        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .print-page { margin: 0; box-shadow: none; }
        }
    </style>
</head>
<body>

<!-- Non-printable toolbar -->
<div class="no-print">
    <div>
        <h1>🖨️ Pratinjau Cetak</h1>
        <p>SIPEMANDIRI — Data Penduduk Non-Permanen</p>
    </div>
    <a href="data.php">← Kembali</a>
    <button onclick="window.print()">🖨️ &nbsp; Cetak Sekarang</button>
</div>

<!-- Printable document -->
<div class="print-page">

    <!-- Kop Surat -->
    <div class="kop-surat">
        <div class="kop-logo">🏛️</div>
        <div class="kop-text">
            <h1>Pemerintah Desa / Kelurahan</h1>
            <h2>SIPEMANDIRI</h2>
            <p>Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen</p>
            <p>Jl. Raya Desa No. 1, Yogyakarta &bull; Telp: (0274) 123456</p>
        </div>
        <div class="kop-logo">🗺️</div>
    </div>

    <!-- Judul -->
    <div class="doc-title">
        <h3>Daftar Data Penduduk Non-Permanen</h3>
        <p>(Penghuni Rumah Kost dan Rumah Kontrak)</p>
    </div>

    <!-- Metadata -->
    <table class="meta-table">
        <tr><td>Tanggal Cetak</td><td>: <?php echo date('d F Y'); ?></td></tr>
        <tr><td>Dicetak Oleh</td><td>: <?php echo htmlspecialchars($_SESSION['user']['name']); ?></td></tr>
        <tr><td>Jabatan</td><td>: <?php echo htmlspecialchars($_SESSION['user']['role']); ?></td></tr>
        <tr><td>Total Data</td><td>: <?php echo count($data_cetak); ?> penduduk terdaftar</td></tr>
    </table>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Registrasi</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>JK</th>
                <th>Asal Daerah</th>
                <th>Jenis Hunian</th>
                <th>RT</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_cetak as $row): ?>
            <tr>
                <td><?php echo $row['No']; ?></td>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo htmlspecialchars($row['Nama']); ?></td>
                <td style="font-family: monospace;"><?php echo $row['NIK']; ?></td>
                <td><?php echo $row['JK']; ?></td>
                <td><?php echo htmlspecialchars($row['Asal']); ?></td>
                <td><?php echo $row['Jenis']; ?></td>
                <td><?php echo $row['RT']; ?></td>
                <td><?php echo $row['Status']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="sign-section">
        <div class="sign-box">
            <p>Yogyakarta, <?php echo date('d F Y'); ?></p>
            <p>Kepala Desa / Petugas Pendataan,</p>
            <p class="sign-name">_________________________</p>
            <p class="sign-role">NIP. XXXXXXXXXXXXXXXX</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer-note">
        * Dokumen ini dicetak melalui SIPEMANDIRI — Sistem Informasi Pemetaan Lokasi & Data Mandiri Penduduk Non-Permanen.
        Data bersifat rahasia dan hanya untuk keperluan administrasi pemerintahan desa.
    </div>
</div>

</body>
</html>
