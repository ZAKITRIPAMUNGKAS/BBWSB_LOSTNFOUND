<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_'; // nama tabel kamu
    protected $primaryKey = 'idUser_';

    protected $allowedFields = ['nama', 'nama_Lengkap', 'no_HP', 'password_', 'role'];

    public $timestamps = false;
}
