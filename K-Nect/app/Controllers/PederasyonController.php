<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;

class PederasyonController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        $data = [
            'user_id' => $session->get('user_id'),
            'username' => $session->get('username'),
        ];

        return 
            view('K-NECT/Pederasyon/Template/Header') .
            view('K-NECT/Pederasyon/Template/Sidebar') .
            view('K-NECT/Pederasyon/dashboard', $data);
    }

    public function member()
    {
        $userModel = new UserModel();
        $addressModel = new AddressModel();
        $userExtInfoModel = new UserExtInfoModel();

        $users = $userModel
            ->select('
                user.id, user.status, user.last_name, user.first_name, user.middle_name, user.suffix, user.email, user.sex, user.birthdate, user.user_type, user.position, user.sk_username, user.sk_password, user.ped_username, user.ped_password, address.barangay, address.municipality, address.province, address.region, address.zone_purok, user_ext_info.civil_status, user_ext_info.youth_classification, user_ext_info.age_group, user_ext_info.work_status, user_ext_info.educational_background, user_ext_info.sk_voter, user_ext_info.sk_election, user_ext_info.national_voter, user_ext_info.kk_assembly, user_ext_info.how_many_times, user_ext_info.no_why, user_ext_info.birth_certificate, user_ext_info.upload_id
            ')
            ->join('address', 'address.user_id = user.id', 'left')
            ->join('user_ext_info', 'user_ext_info.user_id = user.id', 'left')
            ->findAll();

        // Calculate age for each user
        foreach ($users as &$u) {
            $u['age'] = $u['birthdate'] ? (date_diff(date_create($u['birthdate']), date_create('today'))->y) : '';
        }
        unset($u);
        
        $data['user_list'] = $users;
        return 
            view('K-NECT/Pederasyon/Template/Header') .
            view('K-NECT/Pederasyon/Template/Sidebar') .
            view('K-NECT/Pederasyon/member', $data);
    }
}