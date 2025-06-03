<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Laporan Kehilangan</title>
  <link rel="stylesheet" href="www/public/css/styles.css">
  <style>
   
    .container {
      background-color: #e0e0e0;
      margin: 40px auto;
      padding: 30px;
      width: 80%;
      max-width: 800px;
      border-radius: 8px;
    }

    .back {
      margin-bottom: 10px;
      font-size: 14px;
      cursor: pointer;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      text-decoration: underline;
    }

    .riwayat-item {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .riwayat-item:hover {
      background-color: #f9f9f9;
    }

    .arrow {
      font-size: 18px;
      font-weight: bold;
    }

    @media (max-width: 600px) {
      .riwayat-item {
        flex-direction: column;
        align-items: flex-start;
      }

      .arrow {
        align-self: flex-end;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="back" style="color: #333; text-decoration: none;"><a href="javascript:window.history.back()" style="color: inherit; text-decoration: none;">&lt; Kembali</a></div>
    <h2>Riwayat Lapor Kehilangan</h2>

    <a href="<?= base_url('pages/detail'); ?>" class="riwayat-item">
      <div>Barang: Dompet Hitam</div>
      <div class="arrow">&gt;</div>
    </a>
    <div class="riwayat-item">
      <div>Barang: Kunci Motor</div>
      <div class="arrow">&gt;</div>
    </div>
    <div class="riwayat-item">
      <div>Barang: Handphone</div>
      <div class="arrow">&gt;</div>
    </div>
  </div>
</body>
</html>
<?= $this->endSection(); ?>