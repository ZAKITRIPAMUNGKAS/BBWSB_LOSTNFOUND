<?php

namespace App\Controllers;

use App\Models\KlaimModel;
use App\Models\BarangModel;
use CodeIgniter\Controller;

class Claim extends BaseController
{
    protected $klaimModel;
    protected $barangModel;

    public function __construct()
    {
        $this->klaimModel = new KlaimModel();
        $this->barangModel = new BarangModel();
    }

    public function form($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            return redirect()->to('/')->with('error', 'Barang tidak ditemukan');
        }

        return view('claim/form', [
            'barang_temuan' => $barang
        ]);
    }

    public function submit()
    {
        if (!$this->request->isAJAX() && $this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Permintaan tidak valid.');
        }

        // Validasi input
        $rules = [
            'id_barang' => 'required|is_natural_no_zero',
            'kronologi' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Formulir tidak lengkap atau tidak valid.');
        }

        // Ambil data input
        $id_barang = $this->request->getPost('id_barang');
        $kronologi = $this->request->getPost('kronologi');

        // Cek apakah barang valid
        $barang = $this->barangModel->find($id_barang);
        if (!$barang) {
            return redirect()->to('/')->with('error', 'Barang tidak ditemukan.');
        }

        // Ambil user id dari session
        $userId = session()->get('idUser');
        if (!$userId) {
            return redirect()->to('/CI/auth/login')->with('error', 'Silakan login untuk mengklaim barang.');
        }

        // Cek apakah user sudah pernah klaim barang ini
        $existing = $this->klaimModel
            ->where('Barang_Temuan_idBarang_Temuan', $id_barang)
            ->where('User__idUser_', $userId)
            ->whereIn('status_Claim', ['diproses', 'diterima']) // yang masih aktif
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah mengklaim barang ini sebelumnya.');
        }

        // Simpan klaim
        $data = [
            'Barang_Temuan_idBarang_Temuan' => $id_barang,
            'User__idUser_' => $userId,
            'kronologi' => $kronologi,
            'status_Claim' => 'diproses',
            'tanggal_claim' => date('Y-m-d H:i:s')
        ];

        $this->klaimModel->insert($data);

        return redirect()->to('/CI/pages/riwayat')->with('success', 'Klaim Anda telah dikirim dan menunggu verifikasi.');
    }

    public function verifikasi($id, $aksi = null)
    {
        if ($this->request->getMethod() === 'post') {
            $aksi = $this->request->getPost('aksi');
        }

        $klaim = $this->klaimModel->find($id);

        if (!$klaim) {
            return redirect()->to('/admin/manajemenklaim')->with('error', 'Klaim tidak ditemukan.');
        }

        if ($aksi === 'terima') {
            $status = 'diterima';
        } elseif ($aksi === 'tolak') {
            $status = 'ditolak';
        } else {
            return redirect()->to('/CI/admin/manajemenklaim')->with('error', 'Aksi tidak valid.');
        }

        $this->klaimModel->update($id, ['status_Claim' => $status]);

        return redirect()->to('/CI/admin/manajemenklaim')->with('success', 'Status klaim berhasil diperbarui.');
    }
}
