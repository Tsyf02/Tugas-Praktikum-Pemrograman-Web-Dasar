<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Data Warga - SiDesa</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  
  <style>
    :root {
      --primary: #1A56DB;
      --bg: #F0F4FF;
      --bg-card: #FFFFFF;
      --text: #1E293B;
      --text-muted: #64748B;
      --border: #D1D9EF;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--bg);
      color: var(--text);
      margin: 0;
      padding-bottom: 50px;
    }

    header {
      background: #0F3172;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .brand { font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 1.4rem; }
    
    .btn-back {
      text-decoration: none;
      color: white;
      background: rgba(255,255,255,0.1);
      padding: 8px 18px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.85rem;
      border: 1px solid rgba(255,255,255,0.2);
      transition: 0.3s;
    }
    .btn-back:hover { background: rgba(255,255,255,0.2); }

    main {
      max-width: 700px;
      margin: 50px auto;
      padding: 0 20px;
    }

    .form-card {
      background: var(--bg-card);
      padding: 40px;
      border-radius: 28px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.07);
      border: 1px solid var(--border);
    }

    .form-card h2 {
      font-family: 'Nunito', sans-serif;
      font-weight: 800;
      margin-top: 0;
      margin-bottom: 8px;
      color: var(--primary);
    }

    .form-group { margin-bottom: 22px; }
    
    label {
      display: block;
      font-weight: 600;
      font-size: 0.9rem;
      margin-bottom: 8px;
      color: var(--text);
    }

    input, select, textarea {
      width: 100%;
      padding: 14px 18px;
      border-radius: 14px;
      border: 1.5px solid var(--border);
      background: #F8FAFF;
      font-family: 'Poppins', sans-serif;
      font-size: 0.95rem;
      box-sizing: border-box;
      outline: none;
      transition: all 0.3s;
    }

    input:focus, select:focus, textarea:focus {
      border-color: var(--primary);
      background: white;
      box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.1);
    }

    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .btn-save {
      background: var(--primary);
      color: white;
      border: none;
      padding: 16px;
      width: 100%;
      border-radius: 15px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(26, 86, 219, 0.2);
      transition: 0.3s;
      margin-top: 10px;
    }

    .btn-save:hover {
      background: #1345b7;
      transform: translateY(-2px);
      box-shadow: 0 12px 25px rgba(26, 86, 219, 0.3);
    }

    /* Success Toast */
    #status-msg {
      display: none;
      padding: 15px;
      border-radius: 12px;
      background: #DCFCE7;
      color: #166534;
      font-weight: 600;
      margin-bottom: 25px;
      text-align: center;
      border: 1px solid #BBF7D0;
    }
  </style>
</head>
<body>

<header>
  <div class="brand">🏥 SiDesa</div>
  <a href="index.php" class="btn-back">← Kembali ke Beranda</a>
</header>

<main>
  <div class="form-card">
    <div id="status-msg">✅ Data warga berhasil disimpan ke datawarga!</div>
    
    <h2>Pendataan Warga</h2>
    <p style="color: var(--text-muted); margin-bottom: 35px;">Isi formulir dengan lengkap untuk memperbarui database desa.</p>

    <form id="formWarga">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" id="nama" placeholder="Masukkan nama sesuai KTP..." required>
      </div>

      <div class="form-group">
        <label>NIK (Nomor Induk Kependudukan)</label>
        <input type="number" id="nik" placeholder="16 digit nomor induk..." required>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label>Kategori</label>
          <select id="kategori" required>
            <option value="">-- Pilih --</option>
            <option value="Lansia">Lansia</option>
            <option value="Disabilitas Fisik">Disabilitas Fisik</option>
            <option value="Disabilitas Netra">Disabilitas Netra</option>
            <option value="Disabilitas Rungu">Disabilitas Rungu</option>
            <option value="Umum">Umum</option>
          </select>
        </div>
        <div class="form-group">
          <label>Wilayah RT</label>
          <input type="text" id="rt" placeholder="Contoh: 04" required>
        </div>
      </div>

      <div class="form-group">
        <label>Status Kesehatan</label>
        <select id="status_kesehatan">
          <option value="Sehat">Sehat</option>
          <option value="Perlu Pantauan">Perlu Pantauan</option>
          <option value="Sakit">Sakit</option>
        </select>
      </div>

      <div class="form-group">
        <label>Catatan Khusus</label>
        <textarea id="kondisi" rows="3" placeholder="Riwayat penyakit atau kebutuhan alat bantu..."></textarea>
      </div>

      <button type="submit" class="btn-save">Simpan ke Data Warga</button>
    </form>
  </div>
</main>

<script>
  const form = document.getElementById('formWarga');
  const statusMsg = document.getElementById('status-msg');

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    // 1. Ambil data dari form
    const dataBaru = {
      nama: document.getElementById('nama').value,
      nik: document.getElementById('nik').value,
      kategori: document.getElementById('kategori').value,
      rt: document.getElementById('rt').value,
      status: document.getElementById('status_kesehatan').value,
      kondisi: document.getElementById('kondisi').value,
      tgl: new Date().toLocaleDateString('id-ID')
    };

    // 2. Ambil data lama dari LocalStorage (jika ada)
    let dataWarga = JSON.parse(localStorage.getItem('datawarga')) || [];

    // 3. Masukkan data baru ke dalam array
    dataWarga.push(dataBaru);

    // 4. Simpan kembali ke LocalStorage
    localStorage.setItem('datawarga', JSON.stringify(dataWarga));

    // 5. Tampilkan pesan sukses & Reset form
    statusMsg.style.display = 'block';
    form.reset();

    setTimeout(() => {
      statusMsg.style.display = 'none';
    }, 3000);
  });

  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);
</script>

</body>
</html>