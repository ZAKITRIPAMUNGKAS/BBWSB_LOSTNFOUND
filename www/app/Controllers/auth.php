<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function __construct()
    {
        helper('cookie');
        $this->session = session();

        // Cek jika ada cookie dan user belum login
        if (!$this->session->get('logged_in') && get_cookie('remember_id')) {
            $model = new UserModel();
            $user = $model->find(get_cookie('remember_id'));

            if ($user) {
                $this->session->set([
                    'idUser' => $user['idUser_'],
                    'username' => $user['nama'],
                    'role' => $user['role'],
                    'logged_in' => true
                ]);
            }
        }
    }

    public function login()
    {
        return view('auth/login');
    }

   public function loginProcess()
{
    $model = new UserModel();

    // Ambil input dari form login
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $remember = $this->request->getPost('remember');

    // Cari user berdasarkan username
    $user = $model->where('nama', $username)->first();

    // Verifikasi password
    if ($user && password_verify($password, $user['password_'])) {

        // Set data session login
        $this->session->set([
            'idUser' => $user['idUser_'],
            'username' => $user['nama'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

        // Set cookie jika remember me dicentang
        if ($remember) {
            set_cookie('remember_id', $user['idUser_'], 60 * 60 * 24 * 7); // 7 hari
        }

        // Redirect sesuai role
        return ($user['role'] === 'admin')
            ? redirect()->to(base_url('admin'))
            : redirect()->to(base_url('/'));
    }

    // Jika gagal login
    return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
}

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
{
    helper(['form', 'url']);
    $validation = \Config\Services::validation();

    $validation->setRules([
        'username'      => 'required',
        'nama_lengkap'  => 'required',
        'password'      => 'required|min_length[6]',
        'telepon'       => 'required|numeric|is_unique[user_.no_HP]',
    ], [
        'username' => [
            'required' => 'Nama pengguna wajib diisi.'
        ],
        'nama_lengkap' => [
            'required' => 'Nama lengkap wajib diisi.'
        ],
        'password' => [
            'required' => 'Password wajib diisi.',
            'min_length' => 'Password minimal 6 karakter.'
        ],
        'telepon' => [
            'required' => 'Nomor HP wajib diisi.',
            'numeric' => 'Nomor HP harus berupa angka.',
            'is_unique' => 'Nomor HP sudah digunakan!'
        ]
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
    }

    $model = new UserModel();
    $data = [
        'nama'         => $this->request->getPost('username'),
        'nama_Lengkap' => $this->request->getPost('nama_lengkap'),
        'no_HP'        => $this->request->getPost('telepon'),
        'password_'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'         => 'user'
    ];

    $model->insert($data);

    return redirect()->to(base_url('auth/login'))->with('success', 'Registrasi berhasil. Silakan login!');
}


    public function logout()
    {
        $this->session->destroy();
        setcookie('remember_id', '', time() - 3600, "/"); // Hapus cookie
        return redirect()->to(base_url('/'))->with('success', 'Anda telah logout.');
    }
}

