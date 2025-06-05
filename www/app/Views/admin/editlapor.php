<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

<main class="main-content">
    <h2>Edit Laporan Kehilangan</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="color: red;"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/updatelapor/' . $laporan['idLaporan_Kehilangan']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="nama_Barang">Nama Barang</label>
        <input type="text" name="nama_Barang" id="nama_Barang" value="<?= esc($laporan['nama_Barang']) ?>" required>

        <label for="warna_Barang">Warna Barang</label>
        <input type="text" name="warna_Barang" id="warna_Barang" value="<?= esc($laporan['warna_Barang']) ?>" required>

        <label for="waktu_Kehilangan">Waktu Kehilangan</label>
        <input type="datetime-local" name="waktu_Kehilangan" id="waktu_Kehilangan" value="<?= date('Y-m-d\TH:i', strtotime($laporan['waktu_Kehilangan'])) ?>" required>

        <label for="status_LK">Status</label>
        <select name="status_LK" id="status_LK" required>
            <option value="belum ditemukan" <?= $laporan['status_LK'] === 'belum ditemukan' ? 'selected' : '' ?>>Belum Ditemukan</option>
            <option value="ditemukan" <?= $laporan['status_LK'] === 'ditemukan' ? 'selected' : '' ?>>Ditemukan</option>
        </select>

        <label for="gambar_Barang">Gambar Barang (jika ingin diubah)</label>
        <input type="file" name="gambar_Barang" id="gambar_Barang" accept="image/*">
        <?php if ($laporan['gambar_Barang']): ?>
            <p>Gambar saat ini:</p>
            <img src="<?= base_url('www/public/uploads/' . $laporan['gambar_Barang']) ?>" alt="Gambar Barang" style="max-width: 200px;">
        <?php endif; ?>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="<?= base_url('admin/manajemenlapor') ?>" style="margin-left:10px;">Kembali</a>
    </form>
</main>

<style>
form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}
form label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}
form input[type="text"],
form input[type="datetime-local"],
form select,
form input[type="file"] {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
form button {
    padding: 8px 14px;
    background-color: #2f3e9e;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
form a {
    color: #2f3e9e;
    text-decoration: none;
}
</style>

<?= $this->endSection(); ?>
