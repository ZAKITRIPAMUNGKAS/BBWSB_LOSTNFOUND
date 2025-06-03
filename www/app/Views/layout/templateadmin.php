<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

/* Sidebar */
.sidebar {
  position: fixed; /* agar tetap di tempat */
  top: 0;
  left: 0;
  width: 220px;
  height: 100vh;
  background-color: #2f3e9e;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
}


.sidebar h2 {
  margin-bottom: 20px;
}

.nav-links a {
  display: block;
  margin: 10px 0;
  color: white;
  text-decoration: none;
  font-size: 15px;
}

.nav-links a:hover {
  text-decoration: underline;
}

.profile {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 20px;
}

.profile img {
  border-radius: 50%;
  width: 40px;
  height: 40px;
}

/* Main Content */
.main-content {
  margin-left: 220px;
  background-color: #f4f4f4;
  padding: 30px;
  flex: 1;
  max-width: 100%; /* tambahkan ini */
}


.main-content h1 {
  position: sticky;
  top: 0;
  background-color: #f4f4f4;
  padding: 10px;
  z-index: 11;
}


.tab-bar {
  position: sticky;
  top: 0;
  background-color: #f4f4f4;
  padding: 10px 0;
  z-index: 10;
}

.search-bar {
  position: sticky;
  top: 52px; /* menyesuaikan tinggi tab-bar */
  background-color: #f4f4f4;
  padding: 10px 0;
  z-index: 9;
  display: flex;
  width: 100%;
}


.tab-bar button {
  padding: 10px 15px;
  margin-right: 10px;
  border: none;
  background-color: #e0e0e0;
  cursor: pointer;
}

.tab-bar button.active {
  background-color: #cccccc;
}


.search-bar input {
  padding: 8px;
  flex: 1;
  border: 1px solid #ccc;
  border-right: none;
}

.search-bar button {
  padding: 8px 12px;
  background-color: #ffffff;
  border: 1px solid #ccc;
  cursor: pointer;
}

/* Item Grid */
.item-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 10px;
  padding: 0;
  margin: 0;
  justify-content: start; /* Pastikan grid rapat ke kiri */
  width: 100%;
  box-sizing: border-box;
}



.item-card {
  background-color: white;
  padding: 10px;
  border-radius: 6px;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  gap: 10px;

  max-width: 200px;
  width: 100%;

  /* pastikan tidak ada margin */
  margin: 0;

}



.item-image {
  background-color: #ccc;
  height: 100px;
  border-radius: 4px;
}

.item-info h4 {
  font-size: 16px;
  margin-bottom: 4px;
}

.item-actions {
  display: flex;
  justify-content: space-between;
}

.item-actions .edit {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
}

.item-actions .delete {
  background-color: #f44336;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
}

/* Pagination */
.pagination {
  margin-top: 20px;
  text-align: center;
}

.pagination .dot {
  height: 10px;
  width: 10px;
  margin: 0 5px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}

.pagination .dot.active {
  background-color: #333;
}

  </style>
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>LOST&FOUND</h2>
      <nav class="nav-links">
        <a href="<?= base_url('admin'); ?>">Beranda</a>
        <a href="<?= base_url('admin/tambahbarang'); ?>">Tambah Barang</a>
        <a href="<?= base_url('admin/manajemenklaim'); ?>">Manajemen Klaim</a>
        <a href="<?= base_url('admin/manajemenlapor'); ?>">Manajemen Laporan</a>
        <a href="<?= base_url('admin/manajemenpengguna'); ?>">Manajemen Pengguna</a>
           <a class="logout" href="<?= base_url('auth/logout'); ?>">Logout</a>
      </nav>
      <div class="profile">
        <img src="https://via.placeholder.com/40" alt="Admin" />
        <span>Admin</span>
      </div>
      
   
    </aside>
        <?= $this->renderSection('content'); ?>
</div>
</body>
</html>
