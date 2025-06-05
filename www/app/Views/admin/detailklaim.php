<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

<main class="main-content">
    <h2>Detail Klaim</h2>

<div class="detail-card">
    <?php if (!empty($klaim['gambar_Barang'])) : ?>
        <img src="<?= base_url('www/public/uploads/' . $klaim['gambar_Barang']); ?>" alt="Gambar Barang" class="barang-image">
    <?php else : ?>
        <p><em>Gambar tidak tersedia.</em></p>
    <?php endif; ?>

    <p><strong>Nama Barang:</strong> <?= esc($klaim['nama_Barang']); ?></p>
    <p><strong>Nama Pengklaim:</strong> <?= esc($klaim['nama']); ?></p>
    <p><strong>Status:</strong> <?= esc($klaim['status_Claim']); ?></p>
    <p><strong>Kronologi:</strong> <?= esc($klaim['kronologi']); ?></p>
    <p><strong>Tanggal Klaim:</strong> <?= esc($klaim['tanggal_claim']); ?></p>

    <br>
    <a href="<?= base_url('admin/manajemenklaim'); ?>" class="btn-back">⬅ Kembali</a>
</div>

</main>

<style>
.main-content {
    padding: 20px;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;

    /* Agar konten dapat di-scroll secara horizontal */
    overflow-x: auto;
}

.detail-card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 100vw;
}

.btn-back {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #2f3e9e;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.barang-image {
    width: 100%;
    max-width: 100vw;
    border-radius: 8px;
    margin-bottom: 15px;
}

</style>

<?= $this->endSection(); ?>
