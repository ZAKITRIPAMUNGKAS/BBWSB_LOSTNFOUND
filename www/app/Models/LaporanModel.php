<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan_kehilangan';
    protected $primaryKey = 'idLaporan_Kehilangan';

    protected $allowedFields = [
        'User__idUser_', // jika login diimplementasikan
        'nama_Barang',
        'warna_Barang',
        'waktu_Kehilangan',
        'status_LK',
        'gambar_Barang'
    ];
}
