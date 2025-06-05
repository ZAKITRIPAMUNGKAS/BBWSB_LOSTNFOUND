<?= $this->extend('layout/templateadmin') ?>
<?= $this->section('content'); ?>
<style>
    /* Form Container */
form {
  max-width: 500px;
  margin: 0 auto;
  background: #ffffff;
  padding: 24px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
}

/* Heading */
h2 {
  text-align: center;
  margin-bottom: 24px;
  color: #2e42a0;
}

/* Label */
label {
  display: block;
  margin-bottom: 6px;
  font-weight: 600;
  color: #333;
}

/* Input Fields */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"] {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-bottom: 16px;
  font-size: 14px;
  transition: border 0.2s;
}

input:focus {
  border-color: #2e42a0;
  outline: none;
}

/* Buttons */
button[type="submit"] {
  background-color: #2e42a0;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.2s;
}

button[type="submit"]:hover {
  background-color: #1f2e70;
}

a {
  display: inline-block;
  margin-top: 12px;
  text-decoration: none;
  color: #2e42a0;
  font-size: 14px;
}

a:hover {
  text-decoration: underline;
}

</style>
<h2>Edit Pengguna</h2>
<form action="<?= base_url('admin/updatepengguna/' . $user['idUser_']) ?>" method="post">
    <?= csrf_field() ?>
    
    <label for="nama">Username</label>
    <input type="text" name="nama" id="nama" value="<?= esc($user['nama']) ?>" required>
    <label for="nama_Lengkap">Nama Lengkap</label>
    <input type="text" name="nama_Lengkap" id="nama_Lengkap" value="<?= esc($user['nama_Lengkap']) ?>" required>
    <label for="no_HP">Nomor HP</label>
    <input type="text" name="no_HP" id="no_HP" value="<?= esc($user['no_HP']) ?>" required>
    <button type="submit">Simpan</button>
    <a href="<?= base_url('admin/manajemenpengguna') ?>">Kembali</a>
</form>
<?= $this->endSection(); ?>
