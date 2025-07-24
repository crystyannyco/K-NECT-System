<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;
use App\Libraries\UserHelper;
use App\Libraries\BarangayHelper;

class SKController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        $skBarangay = $session->get('sk_barangay');
        $barangayName = BarangayHelper::getBarangayName($skBarangay);
        
        $data = [
            'user_id' => $session->get('user_id'),
            'username' => $session->get('username'),
            'sk_barangay' => $skBarangay,
            'barangay_name' => $barangayName
        ];

        return 
            view('K-NECT/SK/Template/Header') .
            view('K-NECT/SK/Template/Sidebar') .
            view('K-NECT/SK/dashboard', $data);
    }

    public function profile()
    {
        $session = session();
        $skBarangay = $session->get('sk_barangay');
        $barangayName = BarangayHelper::getBarangayName($skBarangay);
        
        $userModel = new UserModel();
        $addressModel = new AddressModel();
        $userExtInfoModel = new UserExtInfoModel();

        $query = $userModel
            ->select('user.id, user.user_id, user.status, user.position, address.barangay, user.last_name, user.first_name, user.middle_name, user.birthdate, user.sex, user_ext_info.birth_certificate, user_ext_info.upload_id')
            ->join('address', 'address.user_id = user.id', 'left')
            ->join('user_ext_info', 'user_ext_info.user_id = user.id', 'left');
        
        // Filter by SK's barangay if available
        if ($skBarangay) {
            $query->where('address.barangay', $skBarangay);
        }
        
        $users = $query->findAll();

        // Calculate age for each user
        foreach ($users as &$u) {
            $u['age'] = $u['birthdate'] ? (date_diff(date_create($u['birthdate']), date_create('today'))->y) : '';
        }
        unset($u);

        $data['user_list'] = $users;
        $data['sk_barangay'] = $skBarangay;
        $data['barangay_name'] = $barangayName;

        return 
            view('K-NECT/SK/Template/Header') .
            view('K-NECT/SK/Template/Sidebar') .
            view('K-NECT/SK/profile', $data);
    }


    // Modal-based verify user (accept)
    public function approved($userId)
    {
        if (!$userId) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_id']);
        }
        
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'User not found']);
        }

        $updateData = ['status' => 2];
        if (empty($user['user_id'])) {
            $updateData['user_id'] = UserHelper::generateUnique6DigitId();
        }

        $result = $userModel->update($userId, $updateData);
        
        if ($result) {
            return $this->response->setJSON(['success' => true, 'message' => 'User accepted successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Failed to accept user']);
        }
    }

    public function reject($userId)
    {
        $reason = $this->request->getPost('reason');
        if (!$userId || empty($reason)) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_id or reason']);
        }
        
        $userModel = new UserModel();
        $userExtInfoModel = new UserExtInfoModel();
        
        $db = \Config\Database::connect();
        $db->transStart();
        
        $userModel->update($userId, ['status' => 3]);
        $userExtInfoModel->update($userId, ['reason' => $reason]);
        
        $db->transComplete();
        
        if ($db->transStatus() === false) {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Failed to reject user']);
        }
        
        return $this->response->setJSON(['success' => true, 'message' => 'User rejected successfully']);
    }

    public function reverify($userId)
    {
        if (!$userId) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_id']);
        }
        
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'User not found']);
        }

        // Change status back to pending (1)
        $result = $userModel->update($userId, ['status' => 1]);
        
        if ($result) {
            return $this->response->setJSON(['success' => true, 'message' => 'User set for re-verification successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Failed to set user for re-verification']);
        }
    }

    public function member()
    {
        $session = session();
        $skBarangay = $session->get('sk_barangay');
        $barangayName = BarangayHelper::getBarangayName($skBarangay);
        
        $userModel = new UserModel();
        $addressModel = new AddressModel();
        $userExtInfoModel = new UserExtInfoModel();

        $query = $userModel
            ->select('
                user.id, user.status, user.last_name, user.first_name, user.middle_name, user.suffix, user.email, user.sex, user.birthdate, user.user_type, user.position, user.sk_username, user.sk_password, user.ped_username, user.ped_password, address.barangay, address.municipality, address.province, address.region, address.zone_purok, user_ext_info.civil_status, user_ext_info.youth_classification, user_ext_info.age_group, user_ext_info.work_status, user_ext_info.educational_background, user_ext_info.sk_voter, user_ext_info.sk_election, user_ext_info.national_voter, user_ext_info.kk_assembly, user_ext_info.how_many_times, user_ext_info.no_why, user_ext_info.birth_certificate, user_ext_info.upload_id
            ')
            ->join('address', 'address.user_id = user.id', 'left')
            ->join('user_ext_info', 'user_ext_info.user_id = user.id', 'left');
            
        // Filter by SK's barangay if available
        if ($skBarangay) {
            $query->where('address.barangay', $skBarangay);
        }
        
        $users = $query->findAll();

        // Calculate age for each user
        foreach ($users as &$u) {
            $u['age'] = $u['birthdate'] ? (date_diff(date_create($u['birthdate']), date_create('today'))->y) : '';
        }
        unset($u);
        
        $data['user_list'] = $users;
        $data['sk_barangay'] = $skBarangay;
        $data['barangay_name'] = $barangayName;
        
        return 
            view('K-NECT/SK/Template/Header') .
            view('K-NECT/SK/Template/Sidebar') .
            view('K-NECT/SK/member', $data);
    }
}