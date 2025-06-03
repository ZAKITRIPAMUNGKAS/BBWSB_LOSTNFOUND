<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\LaporanModel;

class Pages extends BaseController
{
   public function index()
{
    $keyword = $this->request->getVar('keyword') ?? '';
    $tab = $this->request->getVar('tab') ?? 'temuan'; // default temuan

    if ($tab === 'hilang') {
        $laporanModel = new \App\Models\LaporanModel();
        $query = $laporanModel;

        if ($keyword) {
            $query = $query->like('nama_Barang', $keyword)
                           ->orLike('warna_Barang', $keyword);
        }

        $data = [
            'barang_temuan' => $query->paginate(10),
            'pager' => $laporanModel->pager,
            'keyword' => $keyword,
            'tab' => $tab
        ];
    } else {
        $barangModel = new \App\Models\BarangModel();
        $query = $barangModel;

        if ($keyword) {
            $query = $query->like('nama_Barang', $keyword)
                           ->orLike('lokasi_Temu', $keyword);
        }

        $data = [
            'barang_temuan' => $query->paginate(10),
            'pager' => $barangModel->pager,
            'keyword' => $keyword,
            'tab' => $tab
        ];
    }

    return view('beranda', $data);
}



    public function lapor()
    {
        return view('lapor');
    }

    public function riwayat()
    {
        return view('riwayat');
    }

    public function detail()
    {
        return view('detailriwayat');
    }

public function claim($id)
{
    $model = new BarangModel();
    $barang = $model->find($id);

    if (!$barang) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Barang tidak ditemukan.');
    }

    $data['barang_temuan'] = $barang; // Penting!
    return view('claimbarang', $data);
}


public function simpan()
{
    $laporanModel = new LaporanModel();

    $rules = [
        'nama_barang' => 'required|min_length[3]|max_length[100]',
        'warna_barang' => 'required|max_length[255]',
        'tanggal' => 'required|valid_date',
        'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $fileGambar = $this->request->getFile('gambar');
    $namaGambar = $fileGambar->getRandomName();
    $fileGambar->move('www/public/uploads/', $namaGambar);

    // Ambil id user dari session
    $idUser = session()->get('idUser');
    if (!$idUser) {
        return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $data = [
        'User__idUser_' => session()->get('idUser'),
        'nama_Barang' => $this->request->getPost('nama_barang'),
        'warna_Barang' => $this->request->getPost('warna_barang'),
        'waktu_Kehilangan' => $this->request->getPost('tanggal'),
        'status_LK' => 'belum ditemukan',
        'gambar_Barang' => $namaGambar
    ];

    $laporanModel->insert($data);

    return redirect()->to('/ci')->with('pesan', 'Laporan berhasil disimpan!');
}




}
