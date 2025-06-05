<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\LaporanModel;
use App\Models\KlaimModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $barangModel;
    protected $klaimModel;
    protected $laporanModel;
    protected $userModel;
    protected $db; // tambahkan properti db

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->klaimModel = new KlaimModel();
        $this->laporanModel = new LaporanModel();
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();  // inisialisasi koneksi database
    }


    public function index()
{
    $keyword = $this->request->getVar('keyword') ?? '';

    // Barang ditemukan (gunakan model barangModel)
    $barang_temuan = $this->barangModel
        ->like('nama_Barang', $keyword)
        ->paginate(10, 'temuan');

    // Barang hilang / laporan (gunakan model laporanModel)
    $laporan = $this->laporanModel
        ->like('nama_Barang', $keyword)
        ->paginate(10, 'laporan');

    $data = [
        'barang_temuan' => $barang_temuan,
        'laporan' => $laporan,
        'pager' => $this->barangModel->pager,
        'keyword' => $keyword
    ];

    return view('admin/beranda', $data);
}


    public function tambahbarang()
    {
        return view('admin/tambahbarang');
    }

    public function storebarang()
    {
        $rules = [
            'nama_Barang' => 'required|min_length[3]|max_length[100]',
            'lokasi_Temu' => 'required|max_length[255]',
            'gambar_Barang' => 'uploaded[gambar_Barang]|max_size[gambar_Barang,2048]|is_image[gambar_Barang]|mime_in[gambar_Barang,image/jpg,image/jpeg,image/png]',
            'tanggal_Temu' => 'required|valid_date',
            'deskripsi_Barang' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('gambar_Barang');
        $namaGambar = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $namaGambar);

        $data = [
            'nama_Barang' => $this->request->getPost('nama_Barang'),
            'lokasi_Temu' => $this->request->getPost('lokasi_Temu'),
            'gambar_Barang' => $namaGambar,
            'deskripsi_Barang' => $this->request->getPost('deskripsi_Barang'),
            'tanggal_Temu' => $this->request->getPost('tanggal_Temu'),
        ];

        $this->barangModel->insert($data);

        return redirect()->to('tambahbarang')->with('message', 'Barang berhasil ditambahkan!');
    }

    public function manajemenklaim()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->klaimModel
            ->select('claim_barang.*, barang_temuan.nama_Barang, user_.nama')
            ->join('barang_temuan', 'barang_temuan.idBarang_Temuan = claim_barang.Barang_Temuan_idBarang_Temuan')
            ->join('user_', 'user_.idUser_ = claim_barang.User__idUser_');

        if ($keyword) {
            $builder->like('barang_temuan.nama_Barang', $keyword);
        }

        $klaim = $builder->findAll();

        return view('admin/manajemenklaim', [
            'klaim' => $klaim,
            'keyword' => $keyword
        ]);
    }

    public function manajemenlapor()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $laporan = $this->laporanModel->like('nama_Barang', $keyword)
                                         ->orLike('warna_Barang', $keyword)
                                         ->findAll();
        } else {
            $laporan = $this->laporanModel->findAll();
        }

        return view('admin/manajemenlapor', [
            'laporan' => $laporan,
            'keyword' => $keyword
        ]);
    }

    public function manajemenpengguna()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $users = $this->userModel->like('nama', $keyword)
                                    ->orLike('nama_Lengkap', $keyword)
                                    ->orLike('no_HP', $keyword)
                                    ->findAll();
        } else {
            $users = $this->userModel->findAll();
        }

        return view('admin/manajemenpengguna', [
            'users' => $users,
            'keyword' => $keyword
        ]);
    }

    public function edit($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            return redirect()->to('/admin')->with('error', 'Data tidak ditemukan');
        }

        return view('admin/edit_barang', ['barang' => $barang]);
    }

public function hapus($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data yang terkait di claim_barang
        $this->db->table('claim_barang')->where('Barang_Temuan_idBarang_Temuan', $id)->delete();

        // Hapus gambar dari server jika ada
        if ($barang['gambar_Barang'] && file_exists(FCPATH . 'uploads/' . $barang['gambar_Barang'])) {
            unlink(FCPATH . 'uploads/' . $barang['gambar_Barang']);
        }

        // Hapus data barang_temuan
        $this->barangModel->delete($id);

        return redirect()->to(base_url('admin'))->with('success', 'Data barang dan klaim berhasil dihapus.');
    }




    public function update($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            return redirect()->to(site_url('admin'))->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'nama_Barang' => $this->request->getPost('nama_Barang'),
            'lokasi_Temu' => $this->request->getPost('lokasi_Temu'),
            'deskripsi_Barang' => $this->request->getPost('deskripsi_Barang'),
            'tanggal_Temu' => $this->request->getPost('tanggal_Temu'),
        ];

        // Jika ada file baru di-upload
        $file = $this->request->getFile('gambar_Barang');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaGambar = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $namaGambar);
            $data['gambar_Barang'] = $namaGambar;

            // Hapus gambar lama
            $gambarLama = ROOTPATH . 'public/uploads/' . $barang['gambar_Barang'];
            if (file_exists($gambarLama)) {
                unlink($gambarLama);
            }
        }

        $this->barangModel->update($id, $data);

        return redirect()->to(site_url('admin'))->with('success', 'Barang berhasil diperbarui');
    }

    public function detailklaim($id)
    {
        $klaim = $this->klaimModel
            ->select('claim_barang.*, barang_temuan.nama_Barang, barang_temuan.gambar_Barang, user_.nama as nama')
            ->join('barang_temuan', 'barang_temuan.idBarang_Temuan = claim_barang.Barang_Temuan_idBarang_Temuan')
            ->join('user_', 'user_.idUser_ = claim_barang.User__idUser_')
            ->where('idClaim_Barang', $id)
            ->first();

        if (!$klaim) {
            return redirect()->back()->with('error', 'Data klaim tidak ditemukan.');
        }

        return view('admin/detailklaim', [
            'klaim' => $klaim
        ]);
    }

    public function editlapor($id)
    {
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/editlapor', [
            'laporan' => $laporan
        ]);
    }

    public function hapuslapor($id)
    {
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Optional: hapus juga gambar dari server
        if ($laporan['gambar_Barang'] && file_exists(FCPATH . 'uploads/' . $laporan['gambar_Barang'])) {
            unlink(FCPATH . 'uploads/' . $laporan['gambar_Barang']);
        }

        $this->laporanModel->delete($id);

        return redirect()->to(base_url('admin/manajemenlapor'))->with('success', 'Laporan berhasil dihapus.');
    }

    public function updatelapor($id)
{
    $laporan = $this->laporanModel->find($id);

    if (!$laporan) {
        return redirect()->to(base_url('admin/manajemenlapor'))->with('error', 'Laporan tidak ditemukan.');
    }

    // Validasi input
    $rules = [
        'nama_Barang' => 'required|max_length[100]',
        'warna_Barang' => 'required|max_length[50]',
        'waktu_Kehilangan' => 'required|valid_date',
        'status_LK' => 'required|in_list[belum ditemukan,ditemukan]',
        'gambar_Barang' => 'permit_empty|is_image[gambar_Barang]|mime_in[gambar_Barang,image/jpg,image/jpeg,image/png]|max_size[gambar_Barang,2048]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Validasi gagal. Periksa kembali input Anda.');
    }

    $data = [
        'nama_Barang' => $this->request->getPost('nama_Barang'),
        'warna_Barang' => $this->request->getPost('warna_Barang'),
        'waktu_Kehilangan' => $this->request->getPost('waktu_Kehilangan'),
        'status_LK' => $this->request->getPost('status_LK'),
    ];

    $file = $this->request->getFile('gambar_Barang');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaBaru = $file->getRandomName();
        $file->move(FCPATH . 'www/public/uploads', $namaBaru);
        $data['gambar_Barang'] = $namaBaru;

        // Hapus gambar lama jika ada
        if ($laporan['gambar_Barang'] && file_exists(FCPATH . 'www/public/uploads/' . $laporan['gambar_Barang'])) {
            unlink(FCPATH . 'www/public/uploads/' . $laporan['gambar_Barang']);
        }
    }

    $this->laporanModel->update($id, $data);

    return redirect()->to(base_url('admin/manajemenlapor'))->with('success', 'Laporan berhasil diperbarui.');
}

public function editpengguna($id)
{
    $user = $this->userModel->find($id);

    if (!$user) {
        return redirect()->to(base_url('admin/manajemenpengguna'))->with('error', 'Pengguna tidak ditemukan.');
    }

    return view('admin/editpengguna', ['user' => $user]);
}

public function updatepengguna($id)
{
    $user = $this->userModel->find($id);
    if (!$user) {
        return redirect()->to(base_url('admin/manajemenpengguna'))->with('error', 'Pengguna tidak ditemukan.');
    }

    $data = [
        'nama' => $this->request->getPost('nama'),
        'nama_Lengkap' => $this->request->getPost('nama_Lengkap'),
        'no_HP' => $this->request->getPost('no_HP'),
    ];

    $this->userModel->update($id, $data);

    return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Data pengguna berhasil diperbarui.');
}

public function hapuspengguna($id)
{
    // Cek apakah pengguna ada
    $user = $this->userModel->find($id);
    if (!$user) {
        return redirect()->to(base_url('admin/manajemenpengguna'))->with('error', 'Pengguna tidak ditemukan.');
    }

    // Hapus semua laporan kehilangan yang dibuat oleh pengguna ini
    $laporanModel = new \App\Models\LaporanModel();
    $laporanModel->where('User__idUser_', $id)->delete();

    // Hapus pengguna
    $this->userModel->delete($id);

    return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Pengguna dan semua laporannya berhasil dihapus.');
}




}



