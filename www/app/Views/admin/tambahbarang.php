<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>

     <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: sans-serif;
}

.container {
  display: flex;
  height: 100vh;
}
.main-content {
  flex: 1;
  padding: 30px;
  background-color: #f4f4f4;
}

h1 {
  margin-bottom: 20px;
}

.form-card {
  background-color: white;
  padding: 30px;
  border-radius: 8px;
  width: 100%;
  /* max-width: 600px; */
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

.form-card label {
  display: block;
  margin-top: 15px;
  margin-bottom: 5px;
  font-weight: 600;
}

.form-card input[type="text"],
.form-card input[type="file"] {
  width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

.submit-btn {
  margin-top: 20px;
  background-color: #8ef58c;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
}

.submit-btn:hover {
  background-color: #78e077;
}

     </style>
 <main class="main-content">
    <h1>Tambah Barang Temuan</h1>
    
    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    
    <?php if (session()->has('message')): ?>
        <div class="alert alert-success">
            <?= esc(session('message')) ?>
        </div>
    <?php endif ?>
    
    <div class="form-card">
        <form action="<?= base_url('/admin/storebarang') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <label for="nama_Barang">Nama Barang</label>
            <input type="text" id="nama_Barang" name="nama_Barang" placeholder="Masukkan Nama Barang..." value="<?= old('nama_Barang') ?>">

            <label for="lokasi_Temu">Lokasi Penemuan</label>
            <input type="text" id="lokasi_Temu" name="lokasi_Temu" placeholder="Masukkan Lokasi Penemuan..." value="<?= old('lokasi_Temu') ?>">

            <label for="tanggal_Temu">Tanggal Penemuan</label>
            <input type="date" id="tanggal_Temu" name="tanggal_Temu" value="<?= old('tanggal_Temu') ?>">

            <label for="deskripsi_Barang">Deskripsi Barang</label>
            <input type="text" id="deskripsi_Barang" name="deskripsi_Barang" placeholder="Masukkan Deskripsi Barang..." value="<?= old('deskripsi_Barang') ?>">

            <label for="gambar_Barang">Gambar Barang</label>
            <input type="file" id="gambar_Barang" name="gambar_Barang">

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</main>
<?= $this->endSection(); ?>

