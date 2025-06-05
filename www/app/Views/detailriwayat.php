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
  <div class="back">
    <a href="javascript:window.history.back()" style="color: inherit; text-decoration: none;">&lt; Kembali</a>
  </div>
  <h2>Detail Laporan Kehilangan</h2>
  <div class="detail-box">

    <!-- Gambar Barang -->
    <?php if (!empty($laporan['gambar_Barang'])): ?>
      <img src="<?= base_url('www/public/uploads/' . $laporan['gambar_Barang']); ?>" alt="Gambar Barang Hilang" class="detail-image">
    <?php else: ?>
      <p><em>Tidak ada gambar barang.</em></p>
    <?php endif; ?>

    <!-- Detail -->
    <p><strong>Nama Barang:</strong> <?= esc($laporan['nama_Barang']); ?></p>
    <p><strong>Warna Barang:</strong> <?= esc($laporan['warna_Barang']); ?></p>
    <p><strong>Waktu Kehilangan:</strong> <?= esc($laporan['waktu_Kehilangan']); ?></p>
    <p><strong>Status:</strong> <?= esc($laporan['status_LK']); ?></p>
  </div>
</div>

<?= $this->endSection(); ?>

