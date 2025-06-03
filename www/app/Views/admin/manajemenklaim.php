<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>
<main class="main-content">
      <h1>Manajemen Klaim Barang</h1>
      <div class="search-bar">
<form action="<?= base_url('admin'); ?>" method="get" class="search-bar">
    <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? ''); ?>">
    <button type="submit" class="search-btn">🔍</button>
</form>
      </div>

      <div class="item-grid">
        <!-- Item Card -->

        <div class="item-card">
          <div class="item-image" ></div>
          <div class="item-info">
            <h4>iki</h4>
            <p>iki</p>
            <p>iki</p>
            <p>iki</p>
          </div>
          <div class="item-actions">
            <button class="edit">Ubah</button>
            <button class="delete">Hapus</button>
          </div>
        </div>
 
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