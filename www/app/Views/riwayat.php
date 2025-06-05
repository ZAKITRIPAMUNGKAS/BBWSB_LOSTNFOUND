<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="back">
    <a href="<?= base_url('/'); ?>">&lt; Kembali</a>
  </div>

  <h2>Riwayat Lapor Kehilangan</h2>
  <?php if (!empty($riwayat)) : ?>
    <?php foreach ($riwayat as $item) : ?>
      <a href="<?= base_url('riwayat/detail/' . $item['idLaporan_Kehilangan']); ?>" class="riwayat-item">
        <div>
          <strong><?= esc($item['nama_Barang']); ?></strong><br>
          <small>Tanggal: <?= date('d-m-Y', strtotime($item['waktu_Kehilangan'])); ?></small>
        </div>
        <div class="arrow">&gt;</div>
      </a>
    <?php endforeach; ?>
  <?php else : ?>
    <p class="text-muted">Belum ada laporan kehilangan</p>
  <?php endif; ?>

  <h2 style="margin-top: 30px;">Riwayat Klaim Barang Temuan</h2>
  <?php if (!empty($riwayatClaim)) : ?>
    <?php foreach ($riwayatClaim as $item) : ?>
      <a href="<?= base_url('riwayat/klaim/detail/' . $item['idClaim_Barang']); ?>" class="riwayat-item">
        <div>
          <strong><?= esc($item['nama_Barang']); ?></strong><br>
          <small>
            Status: <?= esc($item['status_Claim']); ?><br>
            Tanggal: <?= date('d-m-Y', strtotime($item['tanggal_claim'])); ?>
          </small>
        </div>
        <div class="arrow">&gt;</div>
      </a>
    <?php endforeach; ?>
  <?php else : ?>
    <p class="text-muted">Belum ada klaim barang temuan</p>
  <?php endif; ?>
</div>

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
    text-decoration: none;
    color: inherit;
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

<?= $this->endSection(); ?>
