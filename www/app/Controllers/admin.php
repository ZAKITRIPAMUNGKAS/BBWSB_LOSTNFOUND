<?php

namespace App\Controllers;

use App\Models\BarangModel;

class admin extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword') ?? '';
    $barangModel = new BarangModel();
    
    if ($keyword) {
        $barang = $barangModel->like('nama_Barang', $keyword)
                             ->orLike('lokasi_Temu', $keyword);
    } else {
        $barang = $barangModel;
    }
    
    $data = [
        'barang_temuan' => $barang->paginate(10), // 10 item per halaman
        'pager' => $barangModel->pager,
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
        // Validasi input
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

        // Ambil file gambar
        $file = $this->request->getFile('gambar_Barang');
        
        // Generate nama file unik
        $namaGambar = $file->getRandomName();
        
        // Pindahkan file ke folder public/uploads
        $file->move(ROOTPATH . 'public/uploads', $namaGambar);

        // Simpan data ke database
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
        return view('admin/manajemenklaim');
    }

    public function manajemenlapor()
    {
        return view('admin/manajemenlapor');
    }

    public function manajemenpengguna()
    {
        return view('admin/manajemenpengguna');
    }
}