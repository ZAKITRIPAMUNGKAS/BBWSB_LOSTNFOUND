<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

<style>
    .alert {
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .alert.success {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #3c763d;
    }

    .alert.error {
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #a94442;
    }
</style>



<main class="main-content">
  <h1>Beranda</h1>

  <!-- Tab Bar -->
  <div class="tab-bar">
    <button class="tab-btn active" onclick="openTab('temuan')">Barang Ditemukan</button>
    <button class="tab-btn" onclick="openTab('lapor')">Barang Hilang</button>
  </div>

  <!-- Search Bar -->
  <div class="search-bar">
    <form action="<?= base_url('admin'); ?>" method="get" class="search-bar">
      <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? ''); ?>">
      <button type="submit" class="search-btn">🔍</button>
    </form>
  </div>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert success"><?= session()->getFlashdata('success') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

  <!-- Barang Ditemukan -->
  <div class="tab-content" id="temuan" style="display: block;">
    <div class="item-grid">
      <?php foreach ($barang_temuan as $item) : ?>
        <div class="item-card">
          <div class="item-image" style="background-image: url(<?= base_url('www/public/uploads/' . $item['gambar_Barang']); ?>);background-size: cover; background-position: center; height: 180px;"></div>
          <div class="item-info">
            <h4><?= esc($item['nama_Barang']); ?></h4>
            <p><?= esc($item['lokasi_Temu']); ?></p>
            <p><?= esc($item['tanggal_Temu']); ?></p>
            <p><?= esc($item['deskripsi_Barang']); ?></p>
          </div>
          <div class="item-actions">
            <a href="<?= base_url('admin/edit/' . $item['idBarang_Temuan']); ?>" class="edit">Ubah</a>
            <form action="<?= site_url('admin/hapus/' . $item['idBarang_Temuan']); ?>" method="post" style="display:inline;">
              <?= csrf_field(); ?>
              <button type="submit" class="delete">Hapus</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Barang Hilang -->
  <div class="tab-content" id="lapor" style="display: none;">
    <div class="item-grid">
      <?php foreach ($laporan ?? [] as $item) : ?>
        <div class="item-card">
          <div class="item-image" style="background-image: url(<?= base_url('www/public/uploads/' . $item['gambar_Barang']); ?>);background-size: cover; background-position: center; height: 180px;"></div>
          <div class="item-info">
            <h4><?= esc($item['nama_Barang']); ?></h4>
            <p><?= esc($item['waktu_Kehilangan']); ?></p>
            <p><?= esc($item['status_LK']); ?></p>
          </div>
          <div class="item-actions">
            <a href="<?= base_url('admin/editlapor/' . $item['idLaporan_Kehilangan']); ?>" class="edit">Ubah</a>
            <form action="<?= base_url('admin/hapuslapor/' . $item['idLaporan_Kehilangan']); ?>" method="post" style="display:inline;">
              <?= csrf_field(); ?>
              <button type="submit" class="delete">Hapus</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Pagination (optional) -->
  <div class="pagination">
    <span class="dot active"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
</main>

<!-- JavaScript Tab Logic -->
<script>
  function openTab(tabName) {
    // Hide all tab contents
    const tabContents = document.getElementsByClassName('tab-content');
    for (let i = 0; i < tabContents.length; i++) {
      tabContents[i].style.display = 'none';
    }

    // Remove active class from all tab buttons
    const tabButtons = document.getElementsByClassName('tab-btn');
    for (let i = 0; i < tabButtons.length; i++) {
      tabButtons[i].classList.remove('active');
    }

    // Show the current tab and add active class to the button
    document.getElementById(tabName).style.display = 'block';
    event.currentTarget.classList.add('active');
  }
</script>

<?= $this->endSection(); ?>
