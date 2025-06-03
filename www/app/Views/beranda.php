<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lost & Found</title>
  <link rel="stylesheet" href="<?= base_url('www/public/css/styles.css'); ?>">
</head>
<body>

  <main>
    <div class="top-bar">
<div class="tabs">
    <a href="<?= base_url('?tab=temuan'); ?>">
        <button class="<?= ($tab === 'temuan') ? 'active' : ''; ?>">Ditemukan</button>
    </a>
    <a href="<?= base_url('?tab=hilang'); ?>">
        <button class="<?= ($tab === 'hilang') ? 'active' : ''; ?>">Hilang</button>
    </a>
</div>


  <div class="search-bar">
  <form action="<?= base_url(); ?>" method="get" class="search-bar">
      <input type="hidden" name="tab" value="<?= esc($tab); ?>"> <!-- Tambahkan ini -->
      <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? ''); ?>">
      <button type="submit" class="search-btn">🔍</button>
  </form>
</div>

</div>

    <h2 class="section-title">
    <?= ($tab === 'hilang') ? 'Barang Hilang' : 'Barang Temuan'; ?>
</h2>

<div class="item-grid">
    <?php foreach ($barang_temuan as $item) : ?>
        <div class="item-card">
            <div class="item-image">
                <img src="<?= base_url('www/public/uploads/' . $item['gambar_Barang']); ?>" alt="Gambar" style="max-width: 100%; height: auto;" />
            </div>
            <div class="item-info">
                <p><?= esc($item['nama_Barang']); ?></p>
                <p><?= esc($tab === 'hilang' ? ($item['warna_Barang'] ?? '-') : ($item['lokasi_Temu'] ?? '-')); ?></p>
            </div>

            <?php if ($tab === 'temuan') : ?>
                <a href="<?= base_url('pages/claim/' . $item['idBarang_Temuan']); ?>" class="claim-btn">Claim</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

    <div class="pagination">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
  </main>
</body>
</html>

<?= $this->endSection(); ?>