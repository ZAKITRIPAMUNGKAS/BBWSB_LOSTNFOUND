<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Klaim Barang Temuan</title>
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
  <h2>Detail Klaim Barang Temuan</h2>
  <div class="detail-box">

    <!-- Gambar Barang -->
    <?php if (!empty($klaim['gambar_Barang'])): ?>
      <img src="<?= base_url('www/public/uploads/' . $klaim['gambar_Barang']); ?>" alt="Gambar Barang Temuan" class="detail-image">
    <?php else: ?>
      <p><em>Tidak ada gambar barang.</em></p>
    <?php endif; ?>

    <!-- Detail -->
    <p><strong>Nama Barang:</strong> <?= esc($klaim['nama_Barang']); ?></p>
    <p><strong>Tanggal Klaim:</strong> <?= esc($klaim['tanggal_claim']); ?></p>
    <p><strong>Kronologi Klaim:</strong> <?= esc($klaim['kronologi']); ?></p>
    <p><strong>Status:</strong> <?= esc($klaim['status_Claim']); ?></p>
  </div>
</div>

<?= $this->endSection(); ?>

