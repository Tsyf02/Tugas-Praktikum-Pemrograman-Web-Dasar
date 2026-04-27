<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pencarian & Filter Data - SiDesa</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  
  <style>
    :root {
      --primary: #1A56DB;
      --bg: #F0F4FF;
      --bg-card: #FFFFFF;
      --text: #1E293B;
      --border: #D1D9EF;
      --success: #10B981;
      --warning: #F59E0B;
    }

    body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); margin: 0; padding-bottom: 50px; }
    
    header { 
      background: #0F3172; color: white; padding: 15px 30px; 
      display: flex; justify-content: space-between; align-items: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .brand { font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 1.3rem; }
    .btn-back { color: white; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); padding: 8px 15px; border-radius: 8px; font-size: 0.85rem; }

    main { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
    
    .container-card { 
      background: var(--bg-card); padding: 30px; border-radius: 24px; 
      box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid var(--border); 
    }

    .search-box {
      width: 100%; padding: 15px; border-radius: 12px; border: 1px solid var(--border);
      font-family: 'Poppins', sans-serif; font-size: 1rem; margin-bottom: 25px; outline: none;
    }
    .search-box:focus { border-color: var(--primary); }

    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th { text-align: left; padding: 15px; background: #F8FAFF; color: var(--primary); font-family: 'Nunito'; border-bottom: 2px solid var(--border); }
    td { padding: 15px; border-bottom: 1px solid var(--border); font-size: 0.95rem; }

    /* Badge Style */
    .badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; display: inline-block; }
    .badge-lansia { background: #EBF2FF; color: #1A56DB; }
    .badge-disabilitas { background: #F0F9FF; color: #0EA5E9; }
    .badge-sehat { background: #DCFCE7; color: #166534; }
    .badge-pantauan { background: #FEF3C7; color: #92400E; }
  </style>
</head>
<body>

<header>
    <div class="brand">🏥 SiDesa Filter</div>
    <a href="index.php" class="btn-back">← Kembali Ke Beranda</a>
</header>

<main>
    <div class="container-card">
        <h2 style="font-family: 'Nunito'; margin-bottom: 5px;">Pencarian Data Warga</h2>
        <p style="color: #64748B; margin-bottom: 25px;">Cari dan filter data warga berdasarkan nama, NIK, atau RT.</p>

        <input type="text" id="searchInput" onkeyup="filterTable()" class="search-box" placeholder="Ketik nama atau NIK warga...">

        <table id="wargaTable">
            <thead>
                <tr>
                    <th>Nama Warga</th>
                    <th>NIK</th>
                    <th>Kategori</th>
                    <th>RT</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Budi Santoso</b></td>
                    <td>3201010101010001</td>
                    <td><span class="badge badge-lansia">Tunanetra</span></td>
                    <td>04</td>
                    <td><span class="badge badge-sehat">Sehat</span></td>
                </tr>
                <tr>
                    <td><b>Siti Rahayu</b></td>
                    <td>3201010101010002</td>
                    <td><span class="badge badge-disabilitas">Tunarangu</span></td>
                    <td>02</td>
                    <td><span class="badge badge-pantauan">Pantauan</span></td>
                </tr>
                <tr>
                    <td><b>Mbah Karno</b></td>
                    <td>3201010101010003</td>
                    <td><span class="badge badge-lansia">Tunadaksa</span></td>
                    <td>04</td>
                    <td><span class="badge badge-sehat">Sehat</span></td>
                </tr>
                <tr>
                    <td><b>Dwi Lestari</b></td>
                    <td>3201010101010004</td>
                    <td><span class="badge badge-disabilitas">Tidak Ada</span></td>
                    <td>01</td>
                    <td><span class="badge badge-sehat">Sehat</span></td>
                </tr>
                <tr>
                    <td><b>Haji Mahmud</b></td>
                    <td>3201010101010005</td>
                    <td><span class="badge badge-lansia">Tunagrahita</span></td>
                    <td>03</td>
                    <td><span class="badge badge-pantauan">Pantauan</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
    function filterTable() {
        let input = document.getElementById("searchInput");
        let filter = input.value.toUpperCase();
        let table = document.getElementById("wargaTable");
        let tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            let tdNama = tr[i].getElementsByTagName("td")[0];
            let tdNik = tr[i].getElementsByTagName("td")[1];
            if (tdNama || tdNik) {
                let txtValueNama = tdNama.textContent || tdNama.innerText;
                let txtValueNik = tdNik.textContent || tdNik.innerText;
                if (txtValueNama.toUpperCase().indexOf(filter) > -1 || txtValueNik.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
</script>

</body>
</html>
