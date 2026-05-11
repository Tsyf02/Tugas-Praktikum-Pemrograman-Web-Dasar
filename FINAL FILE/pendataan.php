<?php
session_start();
if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }

$conn = mysqli_connect("localhost","root","","db_penduduk");

if(isset($_POST['simpan'])){
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $nohp   = mysqli_real_escape_string($conn, $_POST['nohp']);
    $jenis  = in_array($_POST['jenis'], ['Kost','Kontrak']) ? $_POST['jenis'] : 'Kost';
    mysqli_query($conn,"INSERT INTO penduduk VALUES('','$nama','$alamat','$nohp','$jenis')");
    $_SESSION['toast'] = ['msg'=>'Data berhasil ditambahkan!','type'=>'success'];
    header("Location: pendataan.php"); exit;
}

if(isset($_POST['update'])){
    $id     = (int)$_POST['id'];
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $nohp   = mysqli_real_escape_string($conn, $_POST['nohp']);
    $jenis  = in_array($_POST['jenis'], ['Kost','Kontrak']) ? $_POST['jenis'] : 'Kost';
    mysqli_query($conn,"UPDATE penduduk SET nama='$nama',alamat='$alamat',nohp='$nohp',jenis='$jenis' WHERE id='$id'");
    $_SESSION['toast'] = ['msg'=>'Data berhasil diperbarui!','type'=>'success'];
    header("Location: pendataan.php"); exit;
}

if(isset($_GET['hapus'])){
    $id = (int)$_GET['hapus'];
    mysqli_query($conn,"DELETE FROM penduduk WHERE id='$id'");
    $_SESSION['toast'] = ['msg'=>'Data berhasil dihapus!','type'=>'success'];
    header("Location: pendataan.php"); exit;
}

$search = '';
if(!empty($_GET['q'])){
    $search = mysqli_real_escape_string($conn, $_GET['q']);
    $data = mysqli_query($conn,"SELECT * FROM penduduk WHERE nama LIKE '%$search%' OR alamat LIKE '%$search%' OR jenis LIKE '%$search%' ORDER BY id DESC");
} else {
    $data = mysqli_query($conn,"SELECT * FROM penduduk ORDER BY id DESC");
}
$total   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk"))['j'];
$kost    = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk WHERE jenis='Kost'"))['j'];
$kontrak = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as j FROM penduduk WHERE jenis='Kontrak'"))['j'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Pendataan — SIPeManDiRi</title>
<link rel="icon" href="LOGOSIPEMANDIRI.png" type="image/png">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
.search-row {
    display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin-bottom:18px;
}
.search-row input {
    flex:1; min-width:200px; padding:10px 14px; border:1.5px solid #e2e8f0;
    border-radius:10px; font-family:'Poppins',sans-serif; font-size:14px;
    color:#374151; background:#f8fafc;
}
.search-row input:focus { outline:none; border-color:#0284C7; }
.search-row button { padding:10px 18px; white-space:nowrap; }
</style>
</head>
<body>

<header>
    <a class="navbar-brand" href="index.php">
        <img src="assets/images/LOGOUNGU.png" alt="Violet Restaurant Logo">
    </a>
    <nav>
        <?php if($_SESSION['role'] == 'admin'): ?>
        <a href="manage_user.php" data-i18n="nav_kelola_user">Kelola User</a>
        <?php endif; ?>
        <a href="beranda.php" data-i18n="nav_beranda">Beranda</a>
        <a href="pendataan.php" class="active" data-i18n="nav_pendataan">Pendataan</a>
        <a href="pemetaan.php" data-i18n="nav_pemetaan">Pemetaan</a>
        <a href="statistik.php" data-i18n="nav_statistik">Statistik</a>
        <a href="tentang.php" data-i18n="nav_tentang">Tentang</a>
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

<section class="cards" style="padding:28px 40px 10px;">
    <div class="card"><h2><?= $total; ?></h2><p data-i18n="card_total">Total Penduduk</p></div>
    <div class="card"><h2><?= $kost; ?></h2><p data-i18n="card_kost">Penghuni Kost</p></div>
    <div class="card"><h2><?= $kontrak; ?></h2><p data-i18n="card_kontrak">Penghuni Kontrak</p></div>
</section>

<section class="container">
    <div class="table-box">
        <div class="table-header">
            <h2>Data Penduduk Non-Permanen</h2>
            <button class="add-btn" onclick="openModal()" data-i18n="btn_tambah">+ Tambah Data</button>
        </div>

        <!-- Search -->
        <form method="GET" class="search-row">
            <input type="text" name="q" placeholder="Cari nama, alamat, atau jenis..." value="<?= htmlspecialchars($search); ?>">
            <button type="submit" class="add-btn">🔍 Cari</button>
            <?php if($search): ?>
            <a href="pendataan.php"><button type="button" class="close" style="margin-left:0;">✕ Reset</button></a>
            <?php endif; ?>
        </form>

        <table>
            <thead>
                <tr>
                    <th data-i18n="table_no">No</th>
                    <th data-i18n="table_nama">Nama</th>
                    <th data-i18n="table_alamat">Alamat</th>
                    <th data-i18n="table_nohp">No HP</th>
                    <th data-i18n="table_jenis">Jenis Tinggal</th>
                    <th data-i18n="table_status">Status</th>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                    <th data-i18n="table_aksi">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td><?= htmlspecialchars($row['nohp']); ?></td>
                <td><?= htmlspecialchars($row['jenis']); ?></td>
                <td>
                    <span class="status <?= strtolower($row['jenis']); ?>">
                        <?= htmlspecialchars($row['jenis']); ?>
                    </span>
                </td>
                <?php if($_SESSION['role'] == 'admin'): ?>
                <td>
                    <button class="edit" onclick="editData('<?= $row['id']; ?>','<?= addslashes($row['nama']); ?>','<?= addslashes($row['alamat']); ?>','<?= $row['nohp']; ?>','<?= $row['jenis']; ?>')">Edit</button>
                    <a href="?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <button class="delete">Hapus</button>
                    </a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Modal -->
<div class="modal" id="modal">
    <div class="modal-content">
        <h2 id="modalTitle">Tambah Data Penduduk</h2>
        <form method="POST" id="dataForm">
            <input type="hidden" name="id" id="inputId">
            <input type="hidden" name="simpan" id="hiddenSimpan" value="1">
            <input type="hidden" name="update" id="hiddenUpdate" style="display:none">
            <input type="text"   name="nama"   id="inputNama"   placeholder="Nama Lengkap" required>
            <input type="text"   name="alamat" id="inputAlamat" placeholder="Alamat Tinggal" required>
            <input type="text"   name="nohp"   id="inputNohp"   placeholder="Nomor HP" required>
            <select name="jenis" id="inputJenis">
                <option value="Kost">Kost</option>
                <option value="Kontrak">Kontrak</option>
            </select>
            <div class="modal-actions">
                <button type="submit" class="save" id="btnSubmit">Simpan</button>
                <button type="button" class="close" onclick="closeModal()">Tutup</button>
            </div>
        </form>
    </div>
</div>

<footer>© 2026 Sistem Informasi Penduduk Non-Permanen</footer>

<script src="toggle.js"></script>
<script>
function openModal(clear = true){
    if(clear){
        document.getElementById('modalTitle').textContent = 'Tambah Data Penduduk';
        document.getElementById('inputId').value = '';
        document.getElementById('inputNama').value = '';
        document.getElementById('inputAlamat').value = '';
        document.getElementById('inputNohp').value = '';
        document.getElementById('inputJenis').value = 'Kost';
        document.getElementById('btnSubmit').textContent = 'Simpan';
        document.getElementById('hiddenSimpan').name = 'simpan';
        document.getElementById('hiddenUpdate').name = '';
    }
    document.getElementById('modal').classList.add('show');
}

function closeModal(){
    document.getElementById('modal').classList.remove('show');
}

function editData(id, nama, alamat, nohp, jenis){
    document.getElementById('modalTitle').textContent = 'Edit Data Penduduk';
    document.getElementById('inputId').value     = id;
    document.getElementById('inputNama').value   = nama;
    document.getElementById('inputAlamat').value = alamat;
    document.getElementById('inputNohp').value   = nohp;
    document.getElementById('inputJenis').value  = jenis;
    document.getElementById('btnSubmit').textContent = 'Update';
    document.getElementById('hiddenSimpan').name = '';
    document.getElementById('hiddenUpdate').name = 'update';
    openModal(false);
}

document.getElementById('modal').addEventListener('click', function(e){
    if(e.target === this) closeModal();
});

<?php if(isset($_SESSION['toast'])): ?>
document.addEventListener('DOMContentLoaded', function(){
    showToast("<?= addslashes($_SESSION['toast']['msg']); ?>", "<?= $_SESSION['toast']['type']; ?>");
});
<?php unset($_SESSION['toast']); endif; ?>
</script>
</body>
</html>
