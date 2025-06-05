<?php

namespace App\Controllers;

use App\Models\LaporanModel;
use App\Models\KlaimModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RiwayatController extends BaseController
{
    protected $laporanModel;
    protected $klaimModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
        $this->klaimModel = new KlaimModel();
    }

    public function index()
    {
        $userId = session()->get('idUser');

        if (!$userId) {
            return redirect()->to(base_url('auth/login'));
        }

        $data = [
            'title' => 'Riwayat Laporan & Klaim',
            'riwayat' => $this->laporanModel
                            ->where('User__idUser_', $userId)
                            ->orderBy('waktu_Kehilangan', 'DESC')
                            ->findAll(),
            'riwayatClaim' => $this->klaimModel->getRiwayatKlaimByUser($userId)
        ];

        return view('riwayat', $data);
    }

    public function show($id = null)
    {
        $userId = session()->get('idUser');
        $laporan = $this->laporanModel
                        ->where('idLaporan_Kehilangan', $id)
                        ->where('User__idUser_', $userId)
                        ->first();

        if (!$laporan) {
            throw PageNotFoundException::forPageNotFound("Laporan tidak ditemukan");
        }

        return view('detailriwayat', [
            'title' => 'Detail Laporan',
            'laporan' => $laporan
        ]);
    }

    public function detailKlaim($id = null)
    {
        $userId = session()->get('idUser');
        $klaim = $this->klaimModel
                     ->select('claim_barang.*, barang_temuan.nama_Barang, barang_temuan.gambar_Barang')
                     ->join('barang_temuan', 'barang_temuan.idBarang_Temuan = claim_barang.Barang_Temuan_idBarang_Temuan')
                     ->where('idClaim_Barang', $id)
                     ->where('User__idUser_', $userId)
                     ->first();

        if (!$klaim) {
            throw PageNotFoundException::forPageNotFound("Klaim tidak ditemukan");
        }

        return view('detailklaim', [
            'title' => 'Detail Klaim',
            'klaim' => $klaim
        ]);
    }
}