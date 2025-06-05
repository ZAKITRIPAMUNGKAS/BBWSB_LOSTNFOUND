<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>
<style>
    /* Tabel */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

thead {
  background-color: #2e42a0;
  color: white;
  text-align: left;
}

thead th {
  padding: 12px 16px;
  font-weight: 600;
}

tbody td {
  padding: 12px 16px;
  border-top: 1px solid #eee;
}

tbody tr:hover {
  background-color: #f1f1f1;
}

/* Tombol aksi */
.btn-group {
  display: flex;
  gap: 8px;
}

.btn-edit, .btn-delete {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  color: white;
  cursor: pointer;
  font-size: 14px;
}

.btn-edit {
  background-color: #28a745; /* Hijau */
}

.btn-delete {
  background-color: #dc3545; /* Merah */
}
</style>

<div class="main-content">
  <h1>Manajemen Pengguna</h1>

 <div class="search-bar">
<form action="<?= base_url('admin/manajemenpengguna'); ?>" method="get" class="search-bar">
    <input type="text" name="keyword" placeholder="cari barang" value="<?= esc($keyword ?? ''); ?>">
    <button type="submit" class="search-btn">🔍</button>
</form>
      </div>

  <table>
    <thead>
      <tr>
        <th>Nama Pengguna</th>
        <th>Nama Lengkap Pengguna</th>
        <th>Nomor Handphone</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php if (!empty($users)): ?>
  <?php foreach ($users as $user): ?>
    <tr>
      <td><?= esc($user['nama']) ?></td>
      <td><?= esc($user['nama_Lengkap']) ?></td>
      <td><?= esc($user['no_HP']) ?></td>
      <td class="btn-group">
        <a href="<?= base_url('admin/editpengguna/' . $user['idUser_']) ?>" class="btn-edit">Edit</a>
        <form action="<?= base_url('admin/hapuspengguna/' . $user['idUser_']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
          <?= csrf_field() ?>
          <button type="submit" class="btn-delete">Hapus</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
  <tr><td colspan="4">Tidak ada data pengguna.</td></tr>
<?php endif; ?>

    </tbody>
  </table>
</div>

<?= $this->endSection(); ?>
