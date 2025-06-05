<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\LaporanModel;

class Pages extends BaseController
{
    public function index()
    {
        $keyword = $this->request->getVar('keyword') ?? '';
        $tab = $this->request->getVar('tab') ?? 'temuan';

        if ($tab === 'hilang') {
            $laporanModel = new LaporanModel();
            if ($keyword) {
                $laporanModel->groupStart()
                             ->like('nama_Barang', $keyword)
                             ->orLike('warna_Barang', $keyword)
                             ->groupEnd();
            }

            $data = [
                'barang_temuan' => $laporanModel->paginate(10),
                'pager' => $laporanModel->pager,
                'keyword' => $keyword,
                'tab' => $tab
            ];
        } else {
            $barangModel = new BarangModel();

            // Filter hanya barang yang belum diklaim atau klaimnya ditolak
            $barangModel->select('barang_temuan.*')
                        ->join('claim_barang', 'claim_barang.Barang_Temuan_idBarang_Temuan = barang_temuan.idBarang_Temuan', 'left')
                        ->groupStart()
                            ->where('claim_barang.idClaim_Barang IS NULL')
                            ->orWhere('claim_barang.status_Claim', 'ditolak')
                        ->groupEnd();

            if ($keyword) {
                $barangModel->groupStart()
                            ->like('nama_Barang', $keyword)
                            ->orLike('lokasi_Temu', $keyword)
                            ->groupEnd();
            }

            $data = [
                'barang_temuan' => $barangModel->paginate(10),
                'pager' => $barangModel->pager,
                'keyword' => $keyword,
                'tab' => $tab
            ];
        }

        return view('beranda', $data);
    }

    public function lapor()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth/login'));
        }

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
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth/login'))->with('error', 'Anda harus login terlebih dahulu.');
        }

        $model = new BarangModel();
        $barang = $model->find($id);

        if (!$barang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Barang tidak ditemukan.');
        }

        $data['barang_temuan'] = $barang;
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

        $idUser = session()->get('idUser');
        if (!$idUser) {
            return redirect()->to('CI/pages/lapor')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $data = [
            'User__idUser_' => $idUser,
            'nama_Barang' => $this->request->getPost('nama_barang'),
            'warna_Barang' => $this->request->getPost('warna_barang'),
            'waktu_Kehilangan' => $this->request->getPost('tanggal'),
            'status_LK' => 'belum ditemukan',
            'gambar_Barang' => $namaGambar
        ];

        $laporanModel->insert($data);

        return redirect()->to('/ci')->with('pesan', 'Laporan berhasil disimpan!');
    }
public function getBelumDiklaim($keyword = null)
{
    $db = \Config\Database::connect();

    // Subquery untuk ambil klaim terakhir per barang
    $builder = $db->table('barang_temuan bt')
        ->select('bt.*')
        ->join(
            // Subquery ambil klaim terakhir per barang
            '(SELECT * FROM claim_barang cb1 
              WHERE cb1.idClaim_Barang = (
                  SELECT MAX(cb2.idClaim_Barang)
                  FROM claim_barang cb2 
                  WHERE cb2.Barang_Temuan_idBarang_Temuan = cb1.Barang_Temuan_idBarang_Temuan
              )
            ) cb',
            'cb.Barang_Temuan_idBarang_Temuan = bt.idBarang_Temuan',
            'left'
        )
        ->where('(cb.status_Claim IS NULL OR cb.status_Claim = "ditolak")');

    // Jika ada pencarian keyword
    if ($keyword) {
        $builder->groupStart()
            ->like('bt.nama_Barang', $keyword)
            ->orLike('bt.lokasi_Temu', $keyword)
            ->groupEnd();
    }

    return $builder->get()->getResultArray();
}




}
