<?=//halaman -> data.php : "Daftar Data Penduduk Non-Permanen"
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$page_title = 'Data Penduduk';

// Dummy dataset (replace with DB query)
$all_data = [
    ['id'=>'SP-2024-0142','nama'=>'Budi Santoso',       'nik'=>'3474010101900001','jk'=>'L','ttl'=>'Sleman, 01 Jan 1990',   'pekerjaan'=>'Karyawan Swasta',  'asal'=>'Magelang',    'jenis'=>'Kost',    'rt'=>'RT 03','tgl_masuk'=>'2024-05-02','status'=>'Aktif'],
    ['id'=>'SP-2024-0141','nama'=>'Siti Rahayu',        'nik'=>'3474015505950002','jk'=>'P','ttl'=>'Bantul, 15 Mei 1995',   'pekerjaan'=>'Mahasiswi',        'asal'=>'Bantul',      'jenis'=>'Kontrak', 'rt'=>'RT 01','tgl_masuk'=>'2024-05-01','status'=>'Aktif'],
    ['id'=>'SP-2024-0140','nama'=>'Ahmad Fauzi',         'nik'=>'3474012203920003','jk'=>'L','ttl'=>'Klaten, 22 Mar 1992',   'pekerjaan'=>'Wiraswasta',       'asal'=>'Klaten',      'jenis'=>'Kost',    'rt'=>'RT 05','tgl_masuk'=>'2024-04-30','status'=>'Aktif'],
    ['id'=>'SP-2024-0139','nama'=>'Dewi Anggraini',      'nik'=>'3474011010980004','jk'=>'P','ttl'=>'Purworejo, 10 Okt 1998','pekerjaan'=>'Mahasiswi',        'asal'=>'Purworejo',   'jenis'=>'Kontrak', 'rt'=>'RT 02','tgl_masuk'=>'2024-04-28','status'=>'Aktif'],
    ['id'=>'SP-2024-0138','nama'=>'Rizki Pratama',       'nik'=>'3474010808960005','jk'=>'L','ttl'=>'Kulon Progo, 08 Ags 1996','pekerjaan'=>'Karyawan Swasta','asal'=>'Kulon Progo', 'jenis'=>'Kost',    'rt'=>'RT 04','tgl_masuk'=>'2024-04-25','status'=>'Nonaktif'],
    ['id'=>'SP-2024-0137','nama'=>'Fitri Handayani',     'nik'=>'3474011212970006','jk'=>'P','ttl'=>'Temanggung, 12 Des 1997','pekerjaan'=>'Guru',            'asal'=>'Temanggung',  'jenis'=>'Kontrak', 'rt'=>'RT 06','tgl_masuk'=>'2024-04-20','status'=>'Aktif'],
    ['id'=>'SP-2024-0136','nama'=>'Eko Prasetyo',        'nik'=>'3474010303940007','jk'=>'L','ttl'=>'Boyolali, 03 Mar 1994', 'pekerjaan'=>'Teknisi',         'asal'=>'Boyolali',    'jenis'=>'Kost',    'rt'=>'RT 01','tgl_masuk'=>'2024-04-18','status'=>'Aktif'],
    ['id'=>'SP-2024-0135','nama'=>'Nurul Hidayah',       'nik'=>'3474010707000008','jk'=>'P','ttl'=>'Grobogan, 07 Jul 2000', 'pekerjaan'=>'Mahasiswi',       'asal'=>'Grobogan',    'jenis'=>'Kost',    'rt'=>'RT 03','tgl_masuk'=>'2024-04-15','status'=>'Aktif'],
    ['id'=>'SP-2024-0134','nama'=>'Hendri Kusuma',       'nik'=>'3474010909880009','jk'=>'L','ttl'=>'Wonogiri, 09 Sep 1988', 'pekerjaan'=>'Pedagang',        'asal'=>'Wonogiri',    'jenis'=>'Kontrak', 'rt'=>'RT 02','tgl_masuk'=>'2024-04-10','status'=>'Aktif'],
    ['id'=>'SP-2024-0133','nama'=>'Maya Sari',            'nik'=>'3474010404990010','jk'=>'P','ttl'=>'Kebumen, 04 Apr 1999',  'pekerjaan'=>'Mahasiswi',       'asal'=>'Kebumen',     'jenis'=>'Kost',    'rt'=>'RT 05','tgl_masuk'=>'2024-04-05','status'=>'Nonaktif'],
];

// Search & filter
$search = trim($_GET['q'] ?? '');
$filter_jenis  = $_GET['jenis']  ?? 'all';
$filter_rt     = $_GET['rt']     ?? 'all';
$filter_status = $_GET['status'] ?? 'all';

$filtered = array_filter($all_data, function($row) use ($search, $filter_jenis, $filter_rt, $filter_status) {
    $match = true;
    if ($search) {
        $haystack = strtolower($row['nama'] . $row['nik'] . $row['asal']);
        $match = $match && str_contains($haystack, strtolower($search));
    }
    if ($filter_jenis !== 'all')  $match = $match && $row['jenis']  === $filter_jenis;
    if ($filter_rt    !== 'all')  $match = $match && $row['rt']     === $filter_rt;
    if ($filter_status !== 'all') $match = $match && $row['status'] === $filter_status;
    return $match;
});

// Simple pagination 
$per_page  = 7;
$page_num  = max(1, (int)($_GET['page'] ?? 1));
$total     = count($filtered);
$total_pages = max(1, ceil($total / $per_page));
$page_num  = min($page_num, $total_pages);
$rows      = array_slice(array_values($filtered), ($page_num - 1) * $per_page, $per_page);

$success_msg = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

include 'includes/header.php';
?>

<div class="breadcrumb fade-up">
    <a href="dashboard.php">🏠 Dashboard</a> <span>/</span> <span>Data Penduduk</span>
</div>

<div class="page-header fade-up fade-up-1">
    <div class="page-header-left">
        <h2>👥 Data Penduduk Non-Permanen</h2>
        <p>Menampilkan <?php echo $total; ?> data dari total <?php echo count($all_data); ?> penduduk terdaftar.</p>
    </div>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="cetak.php" class="btn btn-outline">🖨️ Cetak</a>
        <a href="tambah.php" class="btn btn-gold">➕ Tambah Data</a>
    </div>
</div>

<?php if ($success_msg): ?>
<div class="alert alert-success fade-up">✅ <?php echo htmlspecialchars($success_msg); ?></div>
<?php endif; ?>

<!--  FILTER -  TOOLBAR -->
<div class="card fade-up fade-up-2" style="margin-bottom: 18px;">
    <div class="card-body" style="padding: 14px 18px;">
        <form method="GET" action="data.php">
            <div class="toolbar">
                <div class="search-wrap" style="flex: 1; min-width: 220px;">
                    <span class="search-icon">🔍</span>
                    <input
                        type="text"
                        name="q"
                        value="<?php echo htmlspecialchars($search); ?>"
                        placeholder="Cari nama, NIK, atau asal daerah..."
                        style="padding-left: 36px;"
                    >
                </div>

                <select name="jenis" class="btn btn-outline" style="padding: 9px 14px;">
                    <option value="all"    <?php echo $filter_jenis === 'all'    ? 'selected' : ''; ?>>Semua Jenis</option>
                    <option value="Kost"   <?php echo $filter_jenis === 'Kost'   ? 'selected' : ''; ?>>🛏️ Kost</option>
                    <option value="Kontrak"<?php echo $filter_jenis === 'Kontrak'? 'selected' : ''; ?>>🏠 Kontrak</option>
                </select>

                <select name="rt" class="btn btn-outline" style="padding: 9px 14px;">
                    <option value="all">Semua RT</option>
                    <?php foreach (['RT 01','RT 02','RT 03','RT 04','RT 05','RT 06'] as $rt): ?>
                    <option value="<?php echo $rt; ?>" <?php echo $filter_rt === $rt ? 'selected' : ''; ?>>
                        <?php echo $rt; ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <select name="status" class="btn btn-outline" style="padding: 9px 14px;">
                    <option value="all"      <?php echo $filter_status === 'all'       ? 'selected' : ''; ?>>Semua Status</option>
                    <option value="Aktif"    <?php echo $filter_status === 'Aktif'     ? 'selected' : ''; ?>>✅ Aktif</option>
                    <option value="Nonaktif" <?php echo $filter_status === 'Nonaktif'  ? 'selected' : ''; ?>>❌ Nonaktif</option>
                </select>

                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="data.php" class="btn btn-outline">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- TABLE   -->
<div class="card fade-up fade-up-3">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID Registrasi</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>JK</th>
                    <th>Asal Daerah</th>
                    <th>Pekerjaan</th>
                    <th>Jenis Hunian</th>
                    <th>RT</th>
                    <th>Tgl Masuk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="12" style="text-align: center; padding: 40px; color: var(--gray-400);">
                        😔 Tidak ada data yang sesuai dengan filter.
                        <a href="data.php" style="color: var(--navy-light);">Reset filter</a>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($rows as $i => $row): ?>
                <tr>
                    <td style="color: var(--gray-400); font-size: 0.8rem;">
                        <?php echo ($page_num - 1) * $per_page + $i + 1; ?>
                    </td>
                    <td>
                        <code style="font-size: 0.75rem; color: var(--navy-light); font-weight: 600;">
                            <?php echo $row['id']; ?>
                        </code>
                    </td>
                    <td class="td-name">
                        <strong><?php echo htmlspecialchars($row['nama']); ?></strong>
                        <span><?php echo $row['ttl']; ?></span>
                    </td>
                    <td style="font-size: 0.8rem; font-family: monospace; color: var(--gray-600);">
                        <?php echo $row['nik']; ?>
                    </td>
                    <td>
                        <span class="badge <?php echo $row['jk'] === 'L' ? 'badge-blue' : 'badge-red'; ?>">
                            <?php echo $row['jk'] === 'L' ? '♂ L' : '♀ P'; ?>
                        </span>
                    </td>
                    <td style="font-size: 0.85rem;"><?php echo htmlspecialchars($row['asal']); ?></td>
                    <td style="font-size: 0.82rem; color: var(--gray-600);"><?php echo htmlspecialchars($row['pekerjaan']); ?></td>
                    <td>
                        <span class="badge <?php echo $row['jenis'] === 'Kost' ? 'badge-green' : 'badge-blue'; ?>">
                            <?php echo $row['jenis'] === 'Kost' ? '🛏️' : '🏠'; ?>
                            <?php echo $row['jenis']; ?>
                        </span>
                    </td>
                    <td><?php echo $row['rt']; ?></td>
                    <td style="font-size: 0.8rem; color: var(--gray-400); white-space: nowrap;">
                        <?php echo date('d M Y', strtotime($row['tgl_masuk'])); ?>
                    </td>
                    <td>
                        <span class="badge <?php echo $row['status'] === 'Aktif' ? 'badge-green' : 'badge-gray'; ?>">
                            <?php echo $row['status'] === 'Aktif' ? '✅' : '❌'; ?>
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="detail.php?id=<?php echo urlencode($row['id']); ?>"
                               class="btn btn-outline btn-sm" title="Lihat Detail">👁️</a>
                            <a href="edit.php?id=<?php echo urlencode($row['id']); ?>"
                               class="btn btn-outline btn-sm" title="Edit">✏️</a>
                            <button
                               onclick="konfirmasiHapus('<?php echo htmlspecialchars($row['id']); ?>', '<?php echo htmlspecialchars($row['nama']); ?>')"
                               class="btn btn-danger btn-sm" title="Hapus">🗑️</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <span class="page-info">
            Menampilkan <?php echo ($page_num - 1) * $per_page + 1; ?>–<?php echo min($page_num * $per_page, $total); ?>
            dari <?php echo $total; ?> data
        </span>

        <?php
        $q_params = http_build_query(array_filter([
            'q'      => $search,
            'jenis'  => $filter_jenis  !== 'all' ? $filter_jenis  : null,
            'rt'     => $filter_rt     !== 'all' ? $filter_rt     : null,
            'status' => $filter_status !== 'all' ? $filter_status : null,
        ]));
        ?>

        <a href="?<?php echo $q_params; ?>&page=1" class="page-btn" title="Pertama">«</a>
        <?php for ($p = max(1, $page_num - 2); $p <= min($total_pages, $page_num + 2); $p++): ?>
        <a href="?<?php echo $q_params; ?>&page=<?php echo $p; ?>"
           class="page-btn <?php echo $p === $page_num ? 'active' : ''; ?>">
            <?php echo $p; ?>
        </a>
        <?php endfor; ?>
        <a href="?<?php echo $q_params; ?>&page=<?php echo $total_pages; ?>" class="page-btn" title="Terakhir">»</a>
    </div>
    <?php endif; ?>
</div>

<?php
$page_scripts = '
function konfirmasiHapus(id, nama) {
    if (confirm("Yakin ingin menghapus data penduduk:\\n" + nama + " (" + id + ")?\\n\\nData tidak dapat dipulihkan.")) {
        window.location.href = "hapus.php?id=" + encodeURIComponent(id);
    }
}
';
include 'includes/footer.php';
?>
