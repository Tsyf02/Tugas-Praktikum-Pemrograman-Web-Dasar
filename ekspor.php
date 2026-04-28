<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Pendataan SiDesa</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f4f6;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .no-print-zone {
      background: #0F3172;
      padding: 15px;
      display: flex;
      justify-content: center;
      gap: 15px;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .btn {
      padding: 10px 25px;
      border-radius: 10px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      font-family: 'Poppins';
      transition: 0.3s;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-print { background: #10B981; color: white; }
    .btn-print:hover { background: #059669; }
    .btn-back { background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3); }
    .btn-back:hover { background: rgba(255,255,255,0.2); }

    /* KERTAS LAPORAN */
    .paper {
      background: white;
      width: 210mm; /* A4 Width */
      min-height: 297mm;
      margin: 30px auto;
      padding: 25mm 20mm;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      box-sizing: border-box;
      position: relative;
    }

    /* KOP SURAT */
    .kop-surat {
      display: flex;
      align-items: center;
      border-bottom: 3px double #000;
      padding-bottom: 15px;
      margin-bottom: 30px;
    }

    .kop-text {
      text-align: center;
      width: 100%;
    }

    .kop-text h2 { margin: 0; font-family: 'Nunito'; font-weight: 800; font-size: 22px; text-transform: uppercase; }
    .kop-text h1 { margin: 0; font-family: 'Nunito'; font-weight: 900; font-size: 26px; color: #0F3172; }
    .kop-text p { margin: 5px 0 0; font-size: 12px; color: #666; }

    /* JUDUL LAPORAN */
    .report-title {
      text-align: center;
      margin-bottom: 30px;
    }

    .report-title h3 {
      text-decoration: underline;
      margin-bottom: 5px;
      font-family: 'Nunito';
    }

    /* TABEL DATA */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 50px;
    }

    table th {
      background: #f8fafc;
      border: 1px solid #333;
      padding: 12px;
      font-size: 13px;
      font-family: 'Nunito';
    }

    table td {
      border: 1px solid #333;
      padding: 10px 12px;
      font-size: 12px;
    }

    .text-center { text-align: center; }

    /* TANDA TANGAN */
    .signature-wrapper {
      display: flex;
      justify-content: flex-end;
    }

    .signature-box {
      text-align: center;
      width: 250px;
    }

    .signature-box p { margin: 0; font-size: 14px; }
    .space { height: 80px; }

    /* PRINT RULES */
    @media print {
      body { background: white; }
      .no-print-zone { display: none; }
      .paper {
        margin: 0;
        box-shadow: none;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="no-print-zone">
    <a href="index.php" class="btn btn-back">← Kembali Ke Beranda</a>
    <button class="btn btn-print" onclick="window.print()">🖨️ Cetak ke PDF / Printer</button>
  </div>

  <div class="paper">
    
    <div class="kop-surat">
      <div class="kop-text">
        <h2>PEMERINTAH KABUPATEN INDONESIA</h2>
        <h1>SISTEM INFORMASI DESA (SiDesa)</h1>
        <p>Jl. Raya Desa No. 123, Kec. Maju Jaya, Kode Pos 12345</p>
      </div>
    </div>

    <div class="report-title">
      <h3>LAPORAN DATA LANSIA & DISABILITAS</h3>
      <p style="font-size: 13px;">Periode Laporan: <?php echo date('F Y'); ?></p>
    </div>

    <table>
      <thead>
        <tr>
          <th width="5%">NO</th>
          <th width="35%">NAMA LENGKAP</th>
          <th width="20%">NIK</th>
          <th width="15%">KATEGORI</th>
          <th width="10%">RT</th>
          <th width="15%">STATUS</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">1</td>
          <td><b>Budi Santoso</b></td>
          <td class="text-center">3201010101010001</td>
          <td class="text-center">Tunanetra</td>
          <td class="text-center">01</td>
          <td class="text-center" style="color: #166534;">Sehat</td>
        </tr>
        <tr>
          <td class="text-center">2</td>
          <td><b>Siti Rahayu</b></td>
          <td class="text-center">3201010101010002</td>
          <td class="text-center">Tunarangu</td>
          <td class="text-center">01</td>
          <td class="text-center" style="color: #92400E;">Pantauan</td>
        </tr>
        <tr>
          <td class="text-center">3</td>
          <td><b>Mbah Karno</b></td>
          <td class="text-center">3201010101010003</td>
          <td class="text-center">Tunadaksa</td>
          <td class="text-center">02</td>
          <td class="text-center" style="color: #166534;">Sehat</td>
        </tr>
        <tr>
          <td class="text-center">4</td>
          <td><b>Dewi Lestari</b></td>
          <td class="text-center">3201010101010004</td>
          <td class="text-center">Tidak Ada</td>
          <td class="text-center">02</td>
          <td class="text-center" style="color: #166534;">Sehat</td>
        </tr>
        <tr>
          <td class="text-center">5</td>
          <td><b>Haji Mahmud</b></td>
          <td class="text-center">3201010101010005</td>
          <td class="text-center">Tunagrahita</td>
          <td class="text-center">03</td>
          <td class="text-center" style="color: #92400E;">Pantauan</td>
        </tr>
      </tbody>
    </table>

    <div style="font-size: 12px; margin-bottom: 40px;">
        <p><b>Ringkasan Data:</b></p>
        <ul>
            <li>Total Lansia: 12 Orang</li>
            <li>Total Kondisi Sehat: 6 Orang</li>
            <li>Total Penerima Bantuan: 10 Orang</li>
        </ul>
    </div>

    <div class="signature-wrapper">
      <div class="signature-box">
        <p>Dicetak pada: <?php echo date('d F Y'); ?></p>
        <p>Kepala Urusan Pemerintahan,</p>
        <div class="space"></div>
        <p><b>( ____________________ )</b></p>
        <p>NIP. ............................</p>
      </div>
    </div>

  </div>

</body>
</html>
