<?= $this->extend('layout/templateadmin') ?>

<?= $this->section('content') ?>
<style>
    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .alert.success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert.error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>

<main class="main-content">
    <h1>Manajemen Lapor Kehilangan</h1>

    <div class="search-bar">
        <form action="<?= base_url('admin/manajemenlapor') ?>" method="get" class="search-bar">
            <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? '') ?>">
            <button type="submit" class="search-btn">🔍</button>
        </form>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="item-grid">
        <?php if (!empty($laporan)): ?>
            <?php foreach ($laporan as $row): ?>
                <div class="item-card">
                    <div class="item-image" style="background-image: url('<?= base_url('www/public/uploads/' . $row['gambar_Barang']) ?>'); background-size: cover; background-position: center; height: 180px;"></div>
                    <div class="item-info">
                        <h4><?= esc($row['nama_Barang']) ?></h4>
                        <p>Warna: <?= esc($row['warna_Barang']) ?></p>
                        <p>Waktu Hilang: <?= esc($row['waktu_Kehilangan']) ?></p>
                        <p>Status: <?= esc($row['status_LK']) ?></p>
                    </div>
                    <div class="item-actions">
                        <a href="<?= base_url('admin/editlapor/' . $row['idLaporan_Kehilangan']) ?>" class="edit">Ubah</a>
                        <form action="<?= base_url('admin/hapuslapor/' . $row['idLaporan_Kehilangan']) ?>" method="post" onsubmit="return confirm('Yakin hapus laporan ini?');" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit" class="delete">Hapus</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada laporan ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="pagination">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</main>

<?= $this->endSection() ?>

