<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lapor Kehilangan Barang</title>
  <link rel="stylesheet" href="www/public/css/styles.css">
  <style>
    .profile-icon {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: white;
      display: inline-block;
    }

    .container {
      background-color: #e0e0e0;
      margin: 40px auto;
      padding: 30px;
      width: 80%;
      max-width: 800px;
      border-radius: 8px;
    }

    .back {
      margin-bottom: 10px;
      font-size: 14px;
      cursor: pointer;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 5px;
      font-size: 14px;
    }

    input, textarea {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    .form-full {
      grid-column: span 2;
    }

    .submit-btn {
      grid-column: span 2;
      text-align: center;
    }

    .submit-btn button {
      background-color: #f4c400;
      border: 1px solid #888;
      padding: 10px 40px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }

    @media (max-width: 600px) {
      form {
        grid-template-columns: 1fr;
      }

      .form-full {
        grid-column: span 1;
      }

      .submit-btn {
        grid-column: span 1;
      }
    }
  </style>
</head>
<body>

  <div class="container">
     <div class="back" style="color: #333; text-decoration: none;"><a href="javascript:window.history.back()" style="color: inherit; text-decoration: none;">&lt; Kembali</a></div>
    <h2>Lapor Kehilangan Barang</h2>
    
    <!-- Tambahkan enctype untuk upload file -->
    <<form method="post" action="<?= base_url('/lapor/simpan') ?>" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama-barang">Nama Barang</label>
        <input type="text" id="nama-barang" name="nama_barang" placeholder="Contoh: Dompet" required>
      </div>
      
      <div class="form-group">
        <label for="lokasi">Lokasi Kehilangan</label>
        <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Perpustakaan" required>
      </div>

      <div class="form-group">
        <label for="tanggal">Tanggal Kehilangan</label>
        <input type="date" id="tanggal" name="tanggal" required>
      </div>

      <div class="form-group">
        <label for="kontak">Kontak Penghubung</label>
        <input type="text" id="kontak" name="kontak" placeholder="Contoh: 0812xxxxxxx" required>
      </div>
      
<div class="form-group">
  <label for="warna">Warna Barang</label>
  <input type="text" id="warna" name="warna_barang" placeholder="Contoh: Hitam">
</div>

      <!-- Form Upload Gambar -->
      <div class="form-group">
        <label for="gambar">Upload Gambar Barang</label>
        <input type="file" id="gambar" name="gambar" accept="image/*" required>
      </div>

      <div class="form-group form-full">
        <label for="deskripsi">Deskripsi Barang</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Tulis deskripsi barang..." required></textarea>
      </div>

      <div class="submit-btn">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>

</body>
</html>

<?= $this->endSection(); ?>
