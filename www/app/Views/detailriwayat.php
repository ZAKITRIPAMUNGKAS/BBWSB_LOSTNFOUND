<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Laporan Kehilangan</title>
  <style>
    * {
      box-sizing: border-box;
    }

    .container {
      background-color: #e0e0e0;
      margin: 50px auto;
      padding: 30px;
      max-width: 850px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .back {
      font-size: 14px;
      margin-bottom: 10px;
      cursor: pointer;
      color: #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 2px solid #444;
      display: inline-block;
      padding-bottom: 5px;
    }

    .detail-box {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      min-height: 200px;
    }

    .detail-image {
      display: block;
      margin: 0 auto 20px auto;
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .detail-box {
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="back" style="color: #333; text-decoration: none;"><a href="javascript:window.history.back()" style="color: inherit; text-decoration: none;">&lt; Kembali</a></div>
    <h2 style="color: #333; text-decoration: none;">Detail Laporan Kehilangan</h2>
    <div class="detail-box">

      <!-- Gambar Barang -->
      <img src="/img/barang/dompet-hitam.jpg" alt="Gambar Barang Hilang" class="detail-image">

      <!-- Detail Laporan -->
      <p><strong>Nama Barang:</strong> Dompet Kulit Hitam</p>
      <p><strong>Lokasi Kehilangan:</strong> Perpustakaan Kampus</p>
      <p><strong>Tanggal:</strong> 22 Mei 2025</p>
      <p><strong>Kontak:</strong> 08123456789</p>
      <p><strong>Deskripsi:</strong> Dompet berisi KTP, KTM, dan ATM BCA. Terdapat label nama di dalamnya.</p>
    </div>
  </div>

</body>
</html>
<?= $this->endSection(); ?>
