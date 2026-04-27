<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Statistik Data - SiDesa</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800;900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
  <style>
    :root {
      --primary: #1A56DB;
      --bg: #F0F4FF;
      --bg-card: #FFFFFF;
      --text: #1E293B;
      --border: #D1D9EF;
    }
    body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); margin: 0; padding-bottom: 50px; }
    header { background: #0F3172; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
    .btn-back { color: white; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); padding: 8px 15px; border-radius: 8px; font-size: 0.85rem; }
    main { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
    
    .overview { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .stat-card { background: white; padding: 20px; border-radius: 20px; border: 1px solid var(--border); text-align: center; }
    .stat-card h4 { margin: 0; font-size: 0.8rem; color: #64748B; text-transform: uppercase; }
    .stat-card p { margin: 5px 0 0; font-size: 2rem; font-weight: 800; color: var(--primary); font-family: 'Nunito'; }

    .chart-container-main { background: white; padding: 35px; border-radius: 28px; border: 1px solid var(--border); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    .tab-nav { display: flex; gap: 10px; margin-bottom: 30px; background: #F1F5F9; padding: 6px; border-radius: 14px; width: fit-content; }
    .tab-btn { padding: 10px 20px; border: none; background: transparent; border-radius: 10px; cursor: pointer; font-weight: 600; color: #64748B; transition: 0.3s; }
    .tab-btn.active { background: white; color: var(--primary); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }

    .chart-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 25px; }
    .chart-box { background: #f8faff; padding: 20px; border-radius: 20px; border: 1px solid var(--border); }
    .chart-box h3 { font-family: 'Nunito'; font-size: 1.1rem; margin-top: 0; margin-bottom: 20px; }
    .canvas-wrap { height: 300px; position: relative; }
  </style>
</head>
<body>
<header>
    <div style="font-family:Nunito; font-weight:800; font-size:1.4rem;">🏥 SiDesa Statistik</div>
    <a href="index.php" class="btn-back">← Kembali ke Beranda</a>
</header>
<main>
    <div class="overview">
        <div class="stat-card"><h4>Lansia</h4><p>12</p></div>
        <div class="stat-card"><h4>Disabilitas</h4><p>14</p></div>
        <div class="stat-card"><h4>Kondisi Sehat</h4><p>15</p></div>
        <div class="stat-card"><h4>Pantauan</h4><p>5</p></div>
    </div>

    <div class="chart-container-main">
        <div class="tab-nav">
            <button class="tab-btn active" onclick="changeTab(0, this)">Semua Grafik</button>
            <button class="tab-btn" onclick="changeTab(1, this)">Kelompok Usia</button>
            <button class="tab-btn" onclick="changeTab(2, this)">Kesehatan</button>
        </div>

        <div class="chart-grid">
            <div class="chart-box" id="box-age">
                <h3>📊 Kelompok Usia</h3>
                <div class="canvas-wrap"><canvas id="ageChart"></canvas></div>
            </div>
            <div class="chart-box" id="box-dis">
                <h3>♿ Jenis Disabilitas</h3>
                <div class="canvas-wrap"><canvas id="disChart"></canvas></div>
            </div>
            <div class="chart-box" id="box-health">
                <h3>❤️ Kondisi Kesehatan</h3>
                <div class="canvas-wrap"><canvas id="healthChart"></canvas></div>
            </div>
            <div class="chart-box" id="box-rt">
                <h3>🏠 Distribusi Per RT</h3>
                <div class="canvas-wrap"><canvas id="rtChart"></canvas></div>
            </div>
        </div>
    </div>
</main>

<script>
    const options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { font: { family: 'Poppins' } } } }
    };

    // Data sesuai index.php
    new Chart(document.getElementById('ageChart'), {
        type: 'doughnut',
        data: { labels: ['Lansia', 'Umum'], datasets: [{ data: [12, 8], backgroundColor: ['#1A56DB', '#D1D9EF'] }] },
        options: options
    });

    new Chart(document.getElementById('disChart'), {
        type: 'bar',
        data: { 
            labels: ['Fisik', 'Netra', 'Rungu', 'Wicara'], 
            datasets: [{ label: 'Warga', data: [5, 3, 2, 4], backgroundColor: '#0EA5E9', borderRadius: 8 }] 
        },
        options: options
    });

    new Chart(document.getElementById('healthChart'), {
        type: 'pie',
        data: { labels: ['Sehat', 'Sakit', 'Pantauan'], datasets: [{ data: [6, 3, 3], backgroundColor: ['#10B981', '#EF4444', '#F59E0B'] }] },
        options: options
    });

    new Chart(document.getElementById('rtChart'), {
        type: 'bar',
        data: { 
            labels: ['RT 01', 'RT 02', 'RT 03', 'RT 04'], 
            datasets: [{ label: 'Jumlah', data: [3, 3, 3, 3], backgroundColor: '#6366F1', borderRadius: 8 }] 
        },
        options: options
    });

    function changeTab(idx, btn) {
        const boxes = ['box-age', 'box-dis', 'box-health', 'box-rt'];
        if (idx === 0) {
            boxes.forEach(id => document.getElementById(id).style.display = 'block');
        } else if (idx === 1) {
            boxes.forEach((id, i) => document.getElementById(id).style.display = (i === 0 ? 'block' : 'none'));
        } else {
            boxes.forEach((id, i) => document.getElementById(id).style.display = (i === 2 ? 'block' : 'none'));
        }
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }
</script>
</body>
</html>