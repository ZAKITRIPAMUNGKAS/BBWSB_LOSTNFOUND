<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="<?= base_url('www/public/css/styles.css'); ?>">
    <style>

    </style>
</head>
<body>
    <header>
        <div class="logo">LOST&FOUND</div>
        <nav>
            <a href="<?= base_url('/'); ?>">Beranda</a>
            <a href="<?= base_url('pages/lapor'); ?>">Lapor</a>
            <a href="<?= base_url('pages/riwayat'); ?>">Riwayat</a>
        </nav>
        <div class="auth">
            <?php if (session()->get('logged_in')): ?>
                <span class="user-name">Halo, <?= esc(session()->get('username')) ?></span>
                <a href="<?= base_url('auth/logout') ?>"><button class="logout">Logout</button></a>
            <?php else: ?>
                <a href="<?= base_url('auth/login') ?>"><button class="masuk">Masuk</button></a>
                <a href="<?= base_url('auth/register') ?>"><button class="daftar">Daftar</button></a>
            <?php endif; ?>
        </div>
    </header>
    
    <?= $this->renderSection('content'); ?>
    
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>LOST&FOUND</h4>
                <p>Platform pelaporan dan pencarian barang hilang dengan cepat dan mudah.</p>
            </div>
            
            <div class="footer-section">
                <h4>Menu</h4>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Lapor</a></li>
                    <li><a href="#">Riwayat</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Kontak</h4>
                <p>Email: info@lostfound.com</p>
                <p>Telp: +62 812-3456-7890</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>© 2025 LOST&FOUND. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
