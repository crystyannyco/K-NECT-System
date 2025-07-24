<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;

class KNectController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function login(): string
    {
        // Add security headers to prevent caching
        $this->response->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $this->response->setHeader('Expires', '0');
        
        return view('K-NECT/login');
    }

    public function SKDashboard()
    {
        $session = session();
        $data = [
            'kk_id' => $session->get('kk_id'),
            'username' => $session->get('username'),
        ];
        return view('K-NECT/SK/dashboard', $data);
    }
}
