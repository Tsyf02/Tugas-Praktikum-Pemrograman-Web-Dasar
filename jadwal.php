<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jadwal Kegiatan - SiDesa</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  <style>
    :root {
      --primary: #1A56DB;
      --bg: #F0F4FF;
      --bg-card: #FFFFFF;
      --text: #1E293B;
      --text-muted: #64748B;
      --border: #D1D9EF;
    }

    body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); margin: 0; padding-bottom: 50px; }
    
    header { 
      background: #0F3172; color: white; padding: 15px 30px; 
      display: flex; justify-content: space-between; align-items: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .brand { font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 1.3rem; }
    .btn-back { color: white; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); padding: 8px 15px; border-radius: 8px; font-size: 0.85rem; transition: 0.3s; }
    .btn-back:hover { background: rgba(255,255,255,0.1); }

    main { max-width: 800px; margin: 40px auto; padding: 0 20px; }
    
    .container-card { 
      background: var(--bg-card); padding: 35px; border-radius: 24px; 
      box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid var(--border); 
    }

    .header-section { margin-bottom: 30px; }
    .header-section h2 { font-family: 'Nunito'; margin: 0; font-weight: 800; color: var(--primary); }

    /* TIMELINE STYLE */
    .timeline { position: relative; padding-left: 30px; }
    .timeline::before {
      content: '';
      position: absolute;
      left: 0; top: 0; bottom: 0;
      width: 2px; background: var(--border);
    }

    .event-item {
      position: relative;
      background: #F8FAFF;
      padding: 20px;
      border-radius: 16px;
      margin-bottom: 20px;
      border: 1px solid var(--border);
      transition: 0.3s;
    }
    .event-item:hover { transform: translateX(5px); border-color: var(--primary); }

    .event-item::before {
      content: '';
      position: absolute;
      left: -35px; top: 25px;
      width: 12px; height: 12px;
      border-radius: 50%;
      background: var(--primary);
      border: 4px solid var(--bg-card);
      box-shadow: 0 0 0 2px var(--border);
    }

    .date-badge {
      display: inline-block;
      padding: 4px 12px;
      background: var(--primary-light);
      color: var(--primary);
      border-radius: 8px;
      font-size: 0.8rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .event-title { font-family: 'Nunito'; font-weight: 800; font-size: 1.1rem; margin: 5px 0; }
    .event-info { font-size: 0.85rem; color: var(--text-muted); display: flex; gap: 15px; }
    
    /* Status Labels */
    .status {
      float: right;
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 800;
      padding: 4px 10px;
      border-radius: 6px;
    }
    .status-upcoming { background: #DCFCE7; color: #166534; }
    .status-today { background: #FEF3C7; color: #92400E; }
  </style>
</head>
<body>

<header>
    <div class="brand">🏥 SiDesa Jadwal</div>
    <a href="index.php" class="btn-back">← Kembali ke Beranda</a>
</header>

<main>
    <div class="container-card">
        <div class="header-section">
            <h2>Agenda Kegiatan Desa</h2>
            <p style="color: var(--text-muted);">Jadwal pemeriksaan kesehatan dan kunjungan lapangan terdekat.</p>
        </div>

        <div class="timeline">
            <div class="event-item">
                <span class="status status-today">Hari ini</span>
                <span class="date-badge">11 Mei 2026</span>
                <div class="event-title">Posyandu Lansia - RT 04</div>
                <div class="event-info">
                    <span>🕒 08.00 - 11.00 WIB</span>
                    <span>📍 Balai Pertemuan RT 04</span>
                </div>
            </div>

            <div class="event-item">
                <span class="status status-upcoming">Mendatang</span>
                <span class="date-badge">02 Juli 2026</span>
                <div class="event-title">Kunjungan Rumah (Door to Door) - RT 02</div>
                <div class="event-info">
                    <span>🕒 09.00 - Selesai</span>
                    <span>📍 Wilayah RT 02</span>
                </div>
            </div>

            <div class="event-item">
                <span class="status status-upcoming">Mendatang</span>
                <span class="date-badge">05 Juli 2026</span>
                <div class="event-title">Pembagian Bansos Kesehatan</div>
                <div class="event-info">
                    <span>🕒 10.00 WIB</span>
                    <span>📍 Kantor Balai Desa</span>
                </div>
            </div>

            <div class="event-item">
                <span class="status status-upcoming">Mendatang</span>
                <span class="date-badge">12 Juli 2026</span>
                <div class="event-title">Cek Kesehatan Gratis & Senam Lansia</div>
                <div class="event-info">
                    <span>🕒 07.00 WIB</span>
                    <span>📍 Lapangan Desa</span>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: center; font-size: 0.85rem; color: var(--text-muted);">
            <em>*Jadwal dapat berubah sewaktu-waktu sesuai kebijakan pemerintah desa.</em>
        </div>
    </div>
</main>

<script>
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
</script>

</body>
</html>