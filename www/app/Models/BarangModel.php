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
            ->orLike('deskripsi', $keyword)
            ->findAll();
    }
}
