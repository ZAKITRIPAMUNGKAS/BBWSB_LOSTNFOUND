<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

    <main class="main-content">
      <h1>Beranda</h1>
      <div class="tab-bar">
        <button class="active">Barang Ditemukan</button>
        <button>Barang Hilang</button>
      </div>

      <div class="search-bar">
<form action="<?= base_url('admin'); ?>" method="get" class="search-bar">
    <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? ''); ?>">
    <button type="submit" class="search-btn">🔍</button>
</form>
      </div>

      <div class="item-grid">
        <!-- Item Card -->
         <?php foreach ($barang_temuan as $item) : ?>
        <div class="item-card">
          <div class="item-image" style="background-image: url(www/public/uploads/<?= $item['gambar_Barang']; ?>); background-size: cover; background-position: center; height: 180px;"></div>
          <div class="item-info">
            <h4><?= esc($item['nama_Barang']); ?></h4>
            <p><?= esc($item['lokasi_Temu']); ?></p>
            <p><?= esc($item['tanggal_Temu']); ?></p>
            <p><?= esc($item['deskripsi_Barang']); ?></p>
          </div>
          <div class="item-actions">
            <button class="edit">Ubah</button>
            <button class="delete">Hapus</button>
          </div>
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



<?= $this->endSection(); ?>
