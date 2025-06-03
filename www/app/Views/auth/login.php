<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Lost & Found</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('www/public/css/stylelogin.css') ?>">
</head>
<body>

  <h1 class="brand-title">LOST AND FOUND</h1>

  <div class="form-box">
    <h2>LOGIN</h2>
    <p>Silakan login untuk mengakses sistem Lost & Found.</p>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('auth/login') ?>" method="POST">
      <input type="text" name="username" placeholder="Masukkan Nama Pengguna..." required>
      <input type="password" name="password" placeholder="Masukkan Kata Sandi..." required>
      <button type="submit">Masuk</button>
    </form>
<label style="margin-top: 10px; font-size: 14px; color: #666; font-weight: 500;">
  <input type="checkbox" name="remember">
  Remember Me
</label>
    <div class="switch-link">
      Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar sekarang</a>
    </div>

    <div class="logo">
      <img src="<?= base_url('www/public/img/logo.png') ?>" alt="Logo">
    </div>
  </div>

</body>
</html>
