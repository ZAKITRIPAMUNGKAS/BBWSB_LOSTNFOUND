<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

<style>
    form {
  max-width: 600px;
  margin: 40px auto;
  padding: 24px;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  gap: 16px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

form input[type="text"],
form input[type="date"],
form input[type="file"],
form textarea {
  padding: 10px 14px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
  width: 100%;
  box-sizing: border-box;
  transition: border-color 0.2s ease-in-out;
}

form input:focus,
form textarea:focus {
  border-color: #007BFF;
  outline: none;
}

form textarea {
  resize: vertical;
  min-height: 100px;
}

form button {
  background-color: #007BFF;
  color: white;
  border: none;
  padding: 12px 16px;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

form button:hover {
  background-color: #0056b3;
}

</style>

<form action="<?= base_url('admin/update/' . $barang['idBarang_Temuan']); ?>" method="post" enctype="multipart/form-data">
  <?= csrf_field(); ?>
  <input type="text" name="nama_Barang" value="<?= esc($barang['nama_Barang']); ?>">
  <input type="text" name="lokasi_Temu" value="<?= esc($barang['lokasi_Temu']); ?>">
  <textarea name="deskripsi_Barang"><?= esc($barang['deskripsi_Barang']); ?></textarea>
  <input type="date" name="tanggal_Temu" value="<?= esc($barang['tanggal_Temu']); ?>">
  <input type="file" name="gambar_Barang">
  <button type="submit">Simpan</button>
</form>

<?= $this->endSection(); ?>
