<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // First check if logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Then check if admin
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()
                ->with('error', 'Unauthorized access');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after response is sent
    }
}