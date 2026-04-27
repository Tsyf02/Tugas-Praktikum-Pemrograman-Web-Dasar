<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hak Akses Berbeda - SiDesa</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  
  <style>
    :root[data-theme="light"] {
      --primary: #1A56DB;
      --primary-light: #EBF2FF;
      --bg: #F8FAFC;
      --bg-card: #FFFFFF;
      --text: #1E293B;
      --text-muted: #64748B;
      --border: #E2E8F0;
      --shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    :root[data-theme="dark"] {
      --primary: #3B82F6;
      --primary-light: #1E293B;
      --bg: #0F172A;
      --bg-card: #1E293B;
      --text: #F1F5F9;
      --text-muted: #94A3B8;
      --border: #334155;
      --shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      margin: 0;
      transition: all 0.3s ease;
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

    .brand { font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 1.5rem; }

    .btn-back {
      text-decoration: none;
      color: white;
      background: rgba(255,255,255,0.1);
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      transition: 0.3s;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .btn-back:hover { background: rgba(255,255,255,0.2); }

    main {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .content-card {
      background: var(--bg-card);
      border-radius: 24px;
      padding: 40px;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .header-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .icon-wrapper {
      width: 70px;
      height: 70px;
      background: var(--primary-light);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      margin: 0 auto 20px;
    }

    h1 { font-family: 'Nunito', sans-serif; font-weight: 800; margin: 0; }

    /* Role List */
    .role-list {
      display: grid;
      gap: 20px;
    }

    .role-card {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 25px;
      background: var(--bg);
      border-radius: 16px;
      border: 1px solid var(--border);
      transition: 0.3s;
    }

    .role-card:hover {
      transform: translateX(10px);
      border-color: var(--primary);
    }

    .badge {
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .badge-admin { background: #fee2e2; color: #ef4444; }
    .badge-kader { background: #dcfce7; color: #10b981; }
    .badge-umum { background: #e0f2fe; color: #0ea5e9; }

    .role-content h3 { margin: 0 0 5px 0; font-family: 'Nunito', sans-serif; }
    .role-content p { margin: 0; color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; }

    footer { text-align: center; margin-top: 40px; color: var(--text-muted); font-size: 0.8rem; }
  </style>
</head>
<body>

<header>
  <div class="brand">🏥 SiDesa</div>
  <a href="index.php" class="btn-back">← Kembali Ke Beranda</a>
</header>

<main>
  <div class="content-card">
    <div class="header-section">
      <div class="icon-wrapper">🔐</div>
      <h1>Hak Akses Berbeda</h1>
      <p style="color: var(--text-muted); margin-top: 10px;">Manajemen keamanan data berdasarkan peran pengguna.</p>
    </div>

    <div class="role-list">
      <div class="role-card">
        <div class="role-content">
          <span class="badge badge-admin">Administrator</span>
          <h3 style="margin-top: 10px;">Akses Penuh Sistem</h3>
          <p>Dapat mengelola seluruh data, mengatur akun pengguna, menghapus data, dan mengekspor laporan bulanan desa secara lengkap.</p>
        </div>
      </div>

      <div class="role-card">
        <div class="role-content">
          <span class="badge badge-kader">Kader Desa</span>
          <h3 style="margin-top: 10px;">Manajemen Data Warga</h3>
          <p>Dapat melakukan input pendataan baru, memperbarui kondisi kesehatan warga lansia/disabilitas, dan memantau jadwal kontrol rutin.</p>
        </div>
      </div>

      <div class="role-card">
        <div class="role-content">
          <span class="badge badge-umum">Warga / Umum</span>
          <h3 style="margin-top: 10px;">Akses Informasi Publik</h3>
          <p>Hanya diperbolehkan melihat ringkasan statistik perkembangan desa dan jadwal kegiatan posyandu lansia tanpa melihat data pribadi.</p>
        </div>
      </div>
    </div>
  </div>

  <footer>&copy; 2026 SiDesa - Sistem Informasi Desa</footer>
</main>

<script>
  // Script untuk menjaga konsistensi Dark Mode dari index.php
  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);
</script>

</body>
</html>