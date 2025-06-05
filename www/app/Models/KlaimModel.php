<?php

namespace App\Models;

use CodeIgniter\Model;

class KlaimModel extends Model
{
    protected $table = 'claim_barang';
    protected $primaryKey = 'idClaim_Barang';
    protected $allowedFields = [
        'Barang_Temuan_idBarang_Temuan',
        'User__idUser_',
        'kronologi',
        'status_Claim',
        'tanggal_claim'
    ];

    public function getRiwayatKlaimByUser($userId)
    {
        return $this->select('claim_barang.*, barang_temuan.nama_Barang, barang_temuan.gambar_Barang')
                   ->join('barang_temuan', 'barang_temuan.idBarang_Temuan = claim_barang.Barang_Temuan_idBarang_Temuan')
                   ->where('claim_barang.User__idUser_', $userId)
                   ->orderBy('tanggal_claim', 'DESC')
                   ->findAll();
    }
}