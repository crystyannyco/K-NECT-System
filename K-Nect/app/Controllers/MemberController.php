<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;
use App\Libraries\UserHelper;

class MemberController extends BaseController
{
    public function getUserInfo()
    {
        $userId = $this->request->getPost('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_id']);
        }
        $userModel = new UserModel();
        $user = $userModel
            ->select('
                user.id, user.user_id, user.status, user.last_name, user.first_name, user.middle_name, user.suffix, user.email, user.sex, user.birthdate, user.user_type, user.position,
                address.barangay, address.municipality, address.province, address.region, address.zone_purok,
                user_ext_info.civil_status, user_ext_info.youth_classification, user_ext_info.age_group, user_ext_info.work_status, user_ext_info.educational_background,
                user_ext_info.sk_voter, user_ext_info.sk_election, user_ext_info.national_voter, user_ext_info.kk_assembly, user_ext_info.how_many_times, user_ext_info.no_why,
                user_ext_info.birth_certificate, user_ext_info.upload_id, user_ext_info.profile_picture
            ')
            ->join('address', 'address.user_id = user.id', 'left')
            ->join('user_ext_info', 'user_ext_info.user_id = user.id', 'left')
            ->where('user.id', $userId)
            ->first();

        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'User not found']);
        }

        // Calculate age
        $user['age'] = $user['birthdate'] ? (date_diff(date_create($user['birthdate']), date_create('today'))->y) : '';

        return $this->response->setJSON(['success' => true, 'user' => $user]);
    }

    public function previewDocument($type, $filename)
    {
        // Validate file type
        if (!in_array($type, ['certificate', 'id'])) {
            return $this->response->setStatusCode(400)->setBody('Invalid document type');
        }

        // Validate filename
        if (empty($filename) || strpos($filename, '..') !== false) {
            return $this->response->setStatusCode(400)->setBody('Invalid filename');
        }

        // Build file path
        $filePath = FCPATH . "uploads/{$type}/{$filename}";

        // Check if file exists
        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404)->setBody('File not found');
        }

        // Get file extension
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Set appropriate content type
        $contentTypes = [
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp'
        ];

        $contentType = $contentTypes[$extension] ?? 'application/octet-stream';

        // Return file
        return $this->response
            ->setContentType($contentType)
            ->setBody(file_get_contents($filePath));
    }

    public function updateUserType()
    {
        $userId = $this->request->getPost('user_id');
        $userType = $this->request->getPost('user_type');
        if (!$userId || !$userType) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_id or user_type']);
        }
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'User not found']);
        }

        $updateData = ['user_type' => $userType];

        if ($userType == 2) { // SK Chairman
            // Only generate SK credentials if missing
            if (empty($user['sk_username']) || empty($user['sk_password'])) {
                $updateData['sk_username'] = UserHelper::generateSKUsername($user['first_name'], $user['last_name']);
                $updateData['sk_password'] = UserHelper::generatePassword(8);
            }
        } elseif ($userType == 3) { // Pederasyon Officer
            // Generate SK credentials if missing
            if (empty($user['sk_username']) || empty($user['sk_password'])) {
                $updateData['sk_username'] = UserHelper::generateSKUsername($user['first_name'], $user['last_name']);
                $updateData['sk_password'] = UserHelper::generatePassword(8);
            }
            // Generate PED credentials if missing
            if (empty($user['ped_username']) || empty($user['ped_password'])) {
                $updateData['ped_username'] = UserHelper::generatePEDUsername($user['first_name'], $user['last_name']);
                $updateData['ped_password'] = UserHelper::generatePassword(8);
            }
        }
        // If KK Member (userType == 1), do not change username/password

        $result = $userModel->update($userId, $updateData);
        if ($result) {
            return $this->response->setJSON(['success' => true, 'message' => 'User type updated successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Failed to update user type']);
        }
    }

    public function updateUserPosition()
    {
        $userId = $this->request->getPost('user_id');
        $position = $this->request->getPost('position');
        
        if (!$userId || !$position) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_id or position']);
        }
        
        $userModel = new UserModel();
        $user = $userModel->find($userId);
        
        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'User not found']);
        }

        $updateData = ['position' => $position];

        // Update user_type based on position
        if ($position == 1) { // KK Member
            $updateData['user_type'] = 1;
        } elseif ($position == 2) { // SK Kagawad
            $updateData['user_type'] = 2;
            
            // Generate SK credentials if missing
            if (empty($user['sk_username']) || empty($user['sk_password'])) {
                $updateData['sk_username'] = UserHelper::generateSKUsername($user['first_name'], $user['last_name']);
                $updateData['sk_password'] = UserHelper::generatePassword(8);
            }
        } elseif ($position == 3) { // Secretary
            $updateData['user_type'] = 2;
            
            // Generate Secretary credentials with SEC_ prefix if missing
            if (empty($user['sk_username']) || empty($user['sk_password'])) {
                $updateData['sk_username'] = UserHelper::generateSecretaryUsername($user['first_name'], $user['last_name']);
                $updateData['sk_password'] = UserHelper::generatePassword(8);
            }
        } elseif ($position == 4) { // Treasurer (Pederasyon officer)
            $updateData['user_type'] = 3;
            
            // Generate PED credentials if missing
            if (empty($user['ped_username']) || empty($user['ped_password'])) {
                $updateData['ped_username'] = UserHelper::generatePEDUsername($user['first_name'], $user['last_name']);
                $updateData['ped_password'] = UserHelper::generatePassword(8);
            }
        }

        $result = $userModel->update($userId, $updateData);
        
        if ($result) {
            return $this->response->setJSON(['success' => true, 'message' => 'User position updated successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Failed to update user position']);
        }
    }

    private function generateUniqueUsername($prefix = 'user') {
        return $prefix . '_' . bin2hex(random_bytes(3)) . time();
    }
    
    private function generatePassword($length = 8) {
        return bin2hex(random_bytes($length/2));
    }

    private function generateSKUsername($firstName, $lastName) {
        return 'SK_' . ucfirst(str_replace(' ', '', $firstName)) . ucfirst(str_replace(' ', '', $lastName));
    }
    
    private function generatePEDUsername($firstName, $lastName) {
        return 'PED_' . ucfirst(str_replace(' ', '', $firstName)) . ucfirst(str_replace(' ', '', $lastName));
    }

    private function generateUnique6DigitId() {
        $userModel = new UserModel();
        do {
            $id = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $exists = $userModel->where('user_id', $id)->first();
        } while ($exists);
        return $id;
    }

    public function bulkUpdateUserType()
    {
        $userIds = $this->request->getPost('user_ids');
        $userType = $this->request->getPost('user_type');
        if (!$userIds || !$userType || !is_array($userIds)) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_ids or user_type']);
        }
        $userModel = new UserModel();
        $updated = 0;
        foreach ($userIds as $id) {
            $user = $userModel->find($id);
            if ($user && $user['status'] == 2) {
                $updateData = ['user_type' => $userType];

                if ($userType == 2) { // SK Chairman
                    // Only generate SK credentials if missing
                    if (empty($user['sk_username']) || empty($user['sk_password'])) {
                        $updateData['sk_username'] = UserHelper::generateSKUsername($user['first_name'], $user['last_name']);
                        $updateData['sk_password'] = UserHelper::generatePassword(8);
                    }
                } elseif ($userType == 3) { // Pederasyon Officer
                    // Generate SK credentials if missing
                    if (empty($user['sk_username']) || empty($user['sk_password'])) {
                        $updateData['sk_username'] = UserHelper::generateSKUsername($user['first_name'], $user['last_name']);
                        $updateData['sk_password'] = UserHelper::generatePassword(8);
                    }
                    // Generate PED credentials if missing
                    if (empty($user['ped_username']) || empty($user['ped_password'])) {
                        $updateData['ped_username'] = UserHelper::generatePEDUsername($user['first_name'], $user['last_name']);
                        $updateData['ped_password'] = UserHelper::generatePassword(8);
                    }
                }
                // If KK Member (userType == 1), do not change username/password

                $userModel->update($id, $updateData);
                $updated++;
            }
        }
        if ($updated > 0) {
            return $this->response->setJSON(['success' => true, 'message' => 'User positions updated successfully']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'No users updated (only accepted users can be changed)']);
        }
    }

    public function bulkUpdateUserPosition()
    {
        $userIds = $this->request->getPost('user_ids');
        $position = $this->request->getPost('position');
        
        if (!$userIds || !$position || !is_array($userIds)) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing user_ids or position']);
        }
        
        $userModel = new UserModel();
        $updated = 0;
        
        foreach ($userIds as $id) {
            $user = $userModel->find($id);
            
            if ($user) {
                $updateData = ['position' => $position];

                // Update user_type based on position
                if ($position == 1) { // KK Member
                    $updateData['user_type'] = 1;
                } elseif ($position == 2) { // SK Kagawad
                    $updateData['user_type'] = 2;
                    
                    // Generate SK credentials if missing
                    if (empty($user['sk_username']) || empty($user['sk_password'])) {
                        $updateData['sk_username'] = UserHelper::generateSKUsername($user['first_name'], $user['last_name']);
                        $updateData['sk_password'] = UserHelper::generatePassword(8);
                    }
                } elseif ($position == 3) { // Secretary
                    $updateData['user_type'] = 2;
                    
                    // Generate Secretary credentials with SEC_ prefix if missing
                    if (empty($user['sk_username']) || empty($user['sk_password'])) {
                        $updateData['sk_username'] = UserHelper::generateSecretaryUsername($user['first_name'], $user['last_name']);
                        $updateData['sk_password'] = UserHelper::generatePassword(8);
                    }
                } elseif ($position == 4) { // Treasurer (Pederasyon officer)
                    $updateData['user_type'] = 3;
                    
                    // Generate PED credentials if missing
                    if (empty($user['ped_username']) || empty($user['ped_password'])) {
                        $updateData['ped_username'] = UserHelper::generatePEDUsername($user['first_name'], $user['last_name']);
                        $updateData['ped_password'] = UserHelper::generatePassword(8);
                    }
                }

                $userModel->update($id, $updateData);
                $updated++;
            }
        }
        
        if ($updated > 0) {
            return $this->response->setJSON(['success' => true, 'message' => "Updated {$updated} user positions successfully"]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'No users found to update']);
        }
    }

}