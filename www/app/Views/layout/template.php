<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="<?= base_url('www/public/css/styles.css'); ?>">
    <style>
        /* Header utama */
        
        /* Logo kiri */
        header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        /* Navigasi tengah */
        header nav {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-right: 100px;
        }
        
        header nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            position: relative;
        }
        
        header nav a:hover {
            color: #f4c400;
        }
        
        /* Bagian kanan (login/logout) */
        .auth {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .user-name {
            margin-right: 10px;
            font-weight: 500;
        }
        
        /* Tombol */
        button.logout, button.masuk, button.daftar {
            background-color: #f4c400;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        button.logout:hover,
        button.masuk:hover,
        button.daftar:hover {
            background-color: #d3a800;
        }
        
        /* Responsif: Stack pada layar kecil */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            header nav {
                flex-direction: column;
                width: 100%;
            }
            
            .auth {
                justify-content: flex-start;
                width: 100%;
            }
        }

  .item-card img {
    width: 120px;
    height: 120px;
    object-fit: cover;
  }

  .item-image {
    width: 120px;
    height: 120px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }

        footer {
            background-color: #1d3c8b;
            color: white;
            padding: 40px 30px 20px;
            font-size: 14px;
            margin-top: 40px;
        }
        
        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .footer-section {
            flex: 1;
            min-width: 200px;
        }
        
        .footer-section h4 {
            margin-bottom: 10px;
            font-size: 16px;
            border-bottom: 2px solid #f4c400;
            display: inline-block;
            padding-bottom: 5px;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }
        
        .footer-section ul li a:hover {
            text-decoration: underline;
            color: #f4c400;
        }
        
        .footer-bottom {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 15px;
            font-size: 13px;
            color: #ccc;
        }
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
