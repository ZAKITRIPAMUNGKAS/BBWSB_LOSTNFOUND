<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

<main class="main-content">
    <h1>Manajemen Klaim Barang</h1>

    <div class="search-bar">
        <form action="<?= base_url('admin/manajemenklaim'); ?>" method="get" class="search-bar">
            <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? ''); ?>">
            <button type="submit" class="search-btn">🔍</button>
        </form>
    </div>

    <div class="item-grid">
        <?php if (!empty($klaim)) : ?>
            <?php foreach ($klaim as $item) : ?>
                <div class="item-card">
    <div class="item-info">
        <h4><?= esc($item['nama_Barang']); ?></h4>
        <p>Pengklaim: <?= esc($item['nama']); ?></p>
        <p>Status: <?= esc($item['status_Claim']); ?></p>
        <p>Kronologi: <?= esc(substr($item['kronologi'], 0, 20)) . (strlen($item['kronologi']) > 20 ? '...' : ''); ?></p>
    </div>
    <div class="item-actions">
        <a href="<?= base_url('admin/detailklaim/' . $item['idClaim_Barang']); ?>" class="detail">Detail</a>
       <a href="<?= base_url('admin/verifikasi/' . $item['idClaim_Barang'] . '/terima'); ?>" 
   onclick="return confirm('Yakin ingin menerima klaim ini?');"
   class="edit">Terima</a>

<form action="<?= base_url('admin/verifikasi/' . $item['idClaim_Barang']); ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menolak klaim ini?');">
    <?= csrf_field(); ?>
    <input type="hidden" name="aksi" value="tolak">
    <button type="submit" class="delete">Tolak</button>
</form>
    </div>
</div>

            <?php endforeach; ?>
        <?php else : ?>
            <p>Tidak ada klaim ditemukan.</p>
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

<?= $this->endSection(); ?>
