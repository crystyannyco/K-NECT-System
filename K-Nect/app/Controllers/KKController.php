<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;

class KKController extends BaseController
{
    public function KKDashboard()
    {
        $session = session();
        $data = [
            'user_id' => $session->get('user_id'),
            'username' => $session->get('username'),
        ];

        return view('K-NECT/KK/dashboard', $data);
    }
}