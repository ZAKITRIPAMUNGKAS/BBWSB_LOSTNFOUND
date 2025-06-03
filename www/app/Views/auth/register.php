

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Lost & Found</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('www/public/css/stylelogin.css') ?>">
</head>
<body>

  <h1 class="brand-title">LOST AND FOUND</h1>

  <div class="form-box">
    <h2>REGISTER</h2>
    <p>Daftar sekarang dan mulai temukan barangmu!</p>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('auth/register') ?>" method="POST">
      <input type="text" name="username" placeholder="Masukkan Nama Pengguna..." required>
      <input type="text" name="nama_lengkap" placeholder="Masukkan Nama Lengkap..." required>
      <input type="password" name="password" placeholder="Buat Kata Sandi..." required>
      <input type="text" name="telepon" placeholder="Masukkan Nomor Telepon..." required>
      <button type="submit">Daftar</button>
    </form>

    <div class="switch-link">
      Sudah punya akun? <a href="<?= base_url('auth/login') ?>">Login di sini</a>
    </div>

    <div class="logo">
      <img src="<?= base_url('www/public/img/logo.png') ?>" alt="Logo">
    </div>
  </div>

</body>
</html>

