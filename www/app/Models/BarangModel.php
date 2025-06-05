<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang_temuan';
    protected $primaryKey       = 'idBarang_Temuan';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'nama_Barang',
        'lokasi_Temu',
        'gambar_Barang',
        'deskripsi_Barang',
        'tanggal_Temu',
        'kontak_Penemu'
    ];

    // Method khusus untuk pencarian
    public function search($keyword)
    {
        return $this->table('barang_temuan')
            ->like('nama_Barang', $keyword)
            ->orLike('lokasi_Temu', $keyword)
            ->orLike('deskripsi_Barang', $keyword)
            ->findAll();
    }

    public function getBelumDiklaim($keyword = null)
{
    $this->select('barang_temuan.*')
         ->join('claim_barang', 'claim_barang.Barang_Temuan_idBarang_Temuan = barang_temuan.idBarang_Temuan', 'left')
         ->groupStart()
            ->where('claim_barang.idClaim_Barang IS NULL')
            ->orWhere('claim_barang.status_Claim', 'ditolak')
         ->groupEnd();

    if ($keyword) {
        $this->groupStart()
             ->like('nama_Barang', $keyword)
             ->orLike('lokasi_Temu', $keyword)
             ->groupEnd();
    }

    return $this;
}

}
