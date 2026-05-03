<?= // Halaman untuk Form Tambah Data Penduduk Non-Permanen WEBSITE SIPEMANDIRI
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$page_title = 'Tambah Data Penduduk';

$errors  = [];
$success = false;
$form    = $_POST ?? [];

// ---- Handle form submission ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation
    $required_fields = [
        'nik'        => 'NIK',
        'nama'       => 'Nama Lengkap',
        'jk'         => 'Jenis Kelamin',
        'tgl_lahir'  => 'Tanggal Lahir',
        'tempat_lahir'=> 'Tempat Lahir',
        'asal'       => 'Asal Daerah',
        'jenis'      => 'Jenis Hunian',
        'rt'         => 'RT',
        'alamat'     => 'Alamat Hunian',
        'tgl_masuk'  => 'Tanggal Masuk',
    ];

    foreach ($required_fields as $field => $label) {
        if (empty(trim($_POST[$field] ?? ''))) {
            $errors[$field] = "$label wajib diisi.";
        }
    }

    // NIK length
    if (!empty($_POST['nik']) && strlen(preg_replace('/\D/', '', $_POST['nik'])) !== 16) {
        $errors['nik'] = 'NIK harus terdiri dari 16 digit angka.';
    }

    if (empty($errors)) {
        // Generate ID
        $new_id = 'SP-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // In production: INSERT INTO database
        // Example:
        // $stmt = $pdo->prepare("INSERT INTO penduduk (id, nik, nama, ...) VALUES (?, ?, ?, ...)");
        // $stmt->execute([$new_id, $_POST['nik'], $_POST['nama'], ...]);

        $_SESSION['success'] = "Data penduduk " . htmlspecialchars($_POST['nama']) . " berhasil ditambahkan dengan ID $new_id.";
        header('Location: data.php');
        exit;
    }
}

include 'includes/header.php';
?>

<div class="breadcrumb fade-up">
    <a href="dashboard.php">🏠 Dashboard</a>
    <span>/</span>
    <a href="data.php">Data Penduduk</a>
    <span>/</span>
    <span>Tambah Data</span>
</div>

<div class="page-header fade-up fade-up-1">
    <div class="page-header-left">
        <h2>➕ Tambah Data Penduduk</h2>
        <p>Isi formulir di bawah untuk mendaftarkan penduduk non-permanen baru.</p>
    </div>
    <a href="data.php" class="btn btn-outline">← Kembali</a>
</div>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger fade-up">
    <div>
        <strong>⚠️ Terdapat <?php echo count($errors); ?> kesalahan:</strong>
        <ul style="margin-top: 6px; padding-left: 18px; font-size: 0.85rem;">
            <?php foreach ($errors as $err): ?>
            <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<form method="POST" action="tambah.php" id="formTambah">

<!-- Section 1: Data Pribadi -->
<div class="card fade-up fade-up-2" style="margin-bottom: 20px;">
    <div class="card-header">
        <div class="card-title">👤 Data Pribadi Penduduk</div>
        <span style="font-size: 0.78rem; color: var(--gray-400);">Semua kolom bertanda <span class="required">*</span> wajib diisi</span>
    </div>
    <div class="card-body">
        <div class="form-grid">
            <!-- NIK -->
            <div class="form-group full">
                <label for="nik">NIK (Nomor Induk Kependudukan) <span class="required">*</span></label>
                <div class="input-prefix">
                    <span class="input-prefix-text">🪪 16 digit</span>
                    <input
                        type="text"
                        id="nik"
                        name="nik"
                        maxlength="16"
                        pattern="\d{16}"
                        placeholder="Contoh: 3474010101900001"
                        value="<?php echo htmlspecialchars($form['nik'] ?? ''); ?>"
                        oninput="this.value = this.value.replace(/\D/g,'')"
                        required
                        style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0;"
                        class="<?php echo isset($errors['nik']) ? 'border-red' : ''; ?>"
                    >
                </div>
                <?php if (isset($errors['nik'])): ?>
                <span style="color: var(--danger); font-size: 0.78rem;"><?php echo $errors['nik']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Nama -->
            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="nama" name="nama"
                    placeholder="Sesuai KTP"
                    value="<?php echo htmlspecialchars($form['nama'] ?? ''); ?>"
                    required>
                <?php if (isset($errors['nama'])): ?>
                <span style="color: var(--danger); font-size: 0.78rem;"><?php echo $errors['nama']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label for="jk">Jenis Kelamin <span class="required">*</span></label>
                <select id="jk" name="jk" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" <?php echo ($form['jk'] ?? '') === 'L' ? 'selected' : ''; ?>>♂ Laki-laki</option>
                    <option value="P" <?php echo ($form['jk'] ?? '') === 'P' ? 'selected' : ''; ?>>♀ Perempuan</option>
                </select>
            </div>

            <!-- Tempat Lahir -->
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir <span class="required">*</span></label>
                <input type="text" id="tempat_lahir" name="tempat_lahir"
                    placeholder="Contoh: Yogyakarta"
                    value="<?php echo htmlspecialchars($form['tempat_lahir'] ?? ''); ?>"
                    required>
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir <span class="required">*</span></label>
                <input type="date" id="tgl_lahir" name="tgl_lahir"
                    max="<?php echo date('Y-m-d'); ?>"
                    value="<?php echo htmlspecialchars($form['tgl_lahir'] ?? ''); ?>"
                    required>
            </div>

            <!-- Agama -->
            <div class="form-group">
                <label for="agama">Agama</label>
                <select id="agama" name="agama">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $ag): ?>
                    <option value="<?php echo $ag; ?>" <?php echo ($form['agama'] ?? '') === $ag ? 'selected' : ''; ?>>
                        <?php echo $ag; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Pendidikan -->
            <div class="form-group">
                <label for="pendidikan">Pendidikan Terakhir</label>
                <select id="pendidikan" name="pendidikan">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['SD/Sederajat','SMP/Sederajat','SMA/SMK/Sederajat','D3','S1','S2','S3','Tidak Sekolah'] as $p): ?>
                    <option value="<?php echo $p; ?>" <?php echo ($form['pendidikan'] ?? '') === $p ? 'selected' : ''; ?>>
                        <?php echo $p; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Pekerjaan -->
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" id="pekerjaan" name="pekerjaan"
                    placeholder="Contoh: Mahasiswa, Karyawan Swasta, dll."
                    value="<?php echo htmlspecialchars($form['pekerjaan'] ?? ''); ?>">
            </div>

            <!-- No. HP -->
            <div class="form-group">
                <label for="no_hp">Nomor HP / WA</label>
                <div class="input-prefix">
                    <span class="input-prefix-text">+62</span>
                    <input type="tel" id="no_hp" name="no_hp"
                        placeholder="812XXXXXXXX"
                        value="<?php echo htmlspecialchars($form['no_hp'] ?? ''); ?>"
                        style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0;">
                </div>
            </div>

            <!-- Asal Daerah -->
            <div class="form-group">
                <label for="asal">Asal Daerah / Kabupaten <span class="required">*</span></label>
                <input type="text" id="asal" name="asal"
                    placeholder="Contoh: Magelang, Klaten, dll."
                    value="<?php echo htmlspecialchars($form['asal'] ?? ''); ?>"
                    required>
            </div>

            <!-- Alamat Asal -->
            <div class="form-group full">
                <label for="alamat_asal">Alamat Asal (KTP)</label>
                <textarea id="alamat_asal" name="alamat_asal" placeholder="Alamat lengkap sesuai KTP..."><?php echo htmlspecialchars($form['alamat_asal'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
</div>

<!-- Section 2: Data Hunian -->
<div class="card fade-up fade-up-3" style="margin-bottom: 20px;">
    <div class="card-header">
        <div class="card-title">🏠 Data Hunian di Wilayah</div>
    </div>
    <div class="card-body">
        <div class="form-grid">
            <!-- Jenis Hunian -->
            <div class="form-group">
                <label for="jenis">Jenis Hunian <span class="required">*</span></label>
                <select id="jenis" name="jenis" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Kost"    <?php echo ($form['jenis'] ?? '') === 'Kost'    ? 'selected' : ''; ?>>🛏️ Rumah Kost</option>
                    <option value="Kontrak" <?php echo ($form['jenis'] ?? '') === 'Kontrak' ? 'selected' : ''; ?>>🏠 Rumah Kontrak</option>
                </select>
            </div>

            <!-- RT -->
            <div class="form-group">
                <label for="rt">RT <span class="required">*</span></label>
                <select id="rt" name="rt" required>
                    <option value="">-- Pilih RT --</option>
                    <?php foreach (['RT 01','RT 02','RT 03','RT 04','RT 05','RT 06'] as $rt): ?>
                    <option value="<?php echo $rt; ?>" <?php echo ($form['rt'] ?? '') === $rt ? 'selected' : ''; ?>>
                        <?php echo $rt; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tgl Masuk -->
            <div class="form-group">
                <label for="tgl_masuk">Tanggal Masuk <span class="required">*</span></label>
                <input type="date" id="tgl_masuk" name="tgl_masuk"
                    value="<?php echo htmlspecialchars($form['tgl_masuk'] ?? date('Y-m-d')); ?>"
                    max="<?php echo date('Y-m-d'); ?>"
                    required>
            </div>

            <!-- Tgl Keluar -->
            <div class="form-group">
                <label for="tgl_keluar">Tanggal Keluar / Akhir Kontrak</label>
                <input type="date" id="tgl_keluar" name="tgl_keluar"
                    value="<?php echo htmlspecialchars($form['tgl_keluar'] ?? ''); ?>">
                <span class="form-hint">Kosongkan jika belum diketahui.</span>
            </div>

            <!-- Nama Pemilik -->
            <div class="form-group">
                <label for="nama_pemilik">Nama Pemilik Hunian</label>
                <input type="text" id="nama_pemilik" name="nama_pemilik"
                    placeholder="Nama pemilik kost/kontrak"
                    value="<?php echo htmlspecialchars($form['nama_pemilik'] ?? ''); ?>">
            </div>

            <!-- No. HP Pemilik -->
            <div class="form-group">
                <label for="hp_pemilik">No. HP Pemilik</label>
                <input type="tel" id="hp_pemilik" name="hp_pemilik"
                    placeholder="08XXXXXXXXXX"
                    value="<?php echo htmlspecialchars($form['hp_pemilik'] ?? ''); ?>">
            </div>

            <!-- Alamat Hunian -->
            <div class="form-group full">
                <label for="alamat">Alamat Hunian di Wilayah Ini <span class="required">*</span></label>
                <textarea id="alamat" name="alamat" placeholder="Alamat lengkap hunian (kost/kontrak)..." required><?php echo htmlspecialchars($form['alamat'] ?? ''); ?></textarea>
            </div>

            <!-- Koordinat -->
            <div class="form-group">
                <label for="lat">Latitude (Koordinat)</label>
                <input type="text" id="lat" name="lat"
                    placeholder="Contoh: -7.7956"
                    value="<?php echo htmlspecialchars($form['lat'] ?? ''); ?>">
                <span class="form-hint">Bisa diisi dari hasil klik peta.</span>
            </div>

            <div class="form-group">
                <label for="lng">Longitude (Koordinat)</label>
                <input type="text" id="lng" name="lng"
                    placeholder="Contoh: 110.3695"
                    value="<?php echo htmlspecialchars($form['lng'] ?? ''); ?>">
            </div>

            <!-- Keterangan -->
            <div class="form-group full">
                <label for="keterangan">Keterangan Tambahan</label>
                <textarea id="keterangan" name="keterangan" placeholder="Informasi tambahan yang relevan..."><?php echo htmlspecialchars($form['keterangan'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
</div>

<!-- Submit -->
<div class="card fade-up fade-up-4">
    <div class="card-body" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <button type="submit" class="btn btn-gold btn-lg" id="submitBtn">
            💾 &nbsp; Simpan Data Penduduk
        </button>
        <a href="data.php" class="btn btn-outline btn-lg">Batal</a>
        <button type="reset" class="btn btn-outline btn-lg" onclick="return confirm('Reset semua isian?')">
            🔄 Reset Form
        </button>
        <span style="margin-left: auto; font-size: 0.78rem; color: var(--gray-400);">
            Data akan tersimpan dan langsung tampil di daftar penduduk.
        </span>
    </div>
</div>

</form>

<?php
$page_scripts = '
// Auto-fill date fields
document.getElementById("tgl_masuk").value = document.getElementById("tgl_masuk").value || new Date().toISOString().split("T")[0];

// NIK auto-format display
document.getElementById("nik").addEventListener("input", function() {
    if (this.value.length === 16) {
        this.style.borderColor = "var(--success)";
    } else {
        this.style.borderColor = "";
    }
});

// Form submit loading
document.getElementById("formTambah").addEventListener("submit", function() {
    const btn = document.getElementById("submitBtn");
    btn.textContent = "⏳ Menyimpan...";
    btn.disabled = true;
});
';
include 'includes/footer.php';
?>
