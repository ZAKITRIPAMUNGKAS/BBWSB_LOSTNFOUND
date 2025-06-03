<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<style>
  .claim-container {
    background-color: #eee;
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }

  .back-link {
    display: inline-block;
    margin-bottom: 1rem;
    text-decoration: none;
    color: #333;
    font-size: 0.9rem;
  }

  .title {
    font-size: 1.8rem;
    margin-bottom: 2rem;
    border-bottom: 2px solid #333;
    display: inline-block;
  }

  .claim-form {
    display: flex;
    gap: 3rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }

  .item-detail {
    width: 250px;
  }

  .item-image {
    width: 100%;
    height: 180px;
    background-color: #999;
    border-radius: 8px;
    margin-bottom: 1rem;
    background-size: cover;
    background-position: center;
  }

  .item-desc {
    font-size: 0.9rem;
    color: #444;
    margin-bottom: 0.5rem;
  }

  .form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .form-group label {
    font-weight: bold;
    margin-bottom: 0.5rem;
  }

  textarea {
    min-height: 200px;
    padding: 1rem;
    font-size: 1rem;
    border: 2px solid #2196f3;
    border-radius: 8px;
    resize: vertical;
  }

  .submit-btn {
    background-color: #73e06c;
    border: 2px solid #333;
    color: black;
    padding: 0.8rem 2rem;
    font-size: 1rem;
    border-radius: 8px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    transition: background-color 0.3s ease;
  }

  .submit-btn:hover {
    background-color: #60c25d;
  }
</style>

<main class="claim-container">
  <div class="back"><a href="javascript:window.history.back()" class="back-link">&lt; Kembali</a></div>
  <h1 class="title">Claim Barang</h1>

  <form action="#" method="post">
    <div class="claim-form">
      <div class="item-detail">
        <div class="item-image" style="background-image: url('<?= base_url('www/public/uploads/' . esc($barang_temuan['gambar_Barang'])) ?>');"></div>
        <p class="item-desc"><strong>Nama Barang:</strong> <?= esc($barang_temuan['nama_Barang']) ?></p>
        <p class="item-desc"><strong>Deskripsi:</strong> <?= esc($barang_temuan['deskripsi_Barang']) ?></p>
        <p class="item-desc"><strong>Waktu Kehilangan:</strong> <?= esc($barang_temuan['tanggal_Temu']) ?></p>
      </div>

      <div class="form-group">
        <label for="kronologi">Kronologi Kehilangan</label>
        <textarea name="kronologi" id="kronologi" placeholder="Tuliskan kronologi kehilangan barang Anda di sini..." required></textarea>
      </div>
    </div>

    <input type="hidden" name="id_barang" value="<?= esc($barang_temuan['idBarang_Temuan']) ?>">
    <button type="submit" class="submit-btn">Submit</button>
  </form>
</main>

<?= $this->endSection(); ?>
