<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;

class ProfilingController extends BaseController
{
    public function profiling()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        $step = session('profiling_step') ?? 1;
        $profile_data = session('profile_data') ?? [];
        $demographic_data = session('demographic_data') ?? [];
        $account_data = session('account_data') ?? [];

        $data = [
            'page_title' => 'Profiling',
            'user' => $users,
            'validation' => \Config\Services::validation(),
            'step' => $step,
            'profile_data' => $profile_data,
            'demographic_data' => $demographic_data,
            'account_data' => $account_data,
        ];

        return view('K-NECT/profiling', $data);
    }

    public function profilingStep1()
    {
        $step = session('profiling_step') ?? 1;
        if ($step == 1) {
            session()->set('profiling_step', 2);
            return redirect()->to(base_url('profiling'));
        }

        $userModel = new UserModel();
        $addressModel = new AddressModel();

        // Split profile data for each model
        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name' => $this->request->getPost('last_name'),
            'suffix' => $this->request->getPost('suffix'),
            'birthdate' => $this->request->getPost('birthdate'),
            'sex' => $this->request->getPost('sex'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'user_type' => 1,
            'is_active' => 1,
            'status' => 1,
        ];
        $addressData = [
            'region' => '1', // Always save as ID 1 for Region V
            'province' => '1', // Always save as ID 1 for Camarines Sur
            'municipality' => '1', // Always save as ID 1 for Iriga City
            'barangay' => $this->request->getPost('barangay'),
            'zone_purok' => $this->request->getPost('zone_purok'),
            // Add other required address fields or adjust validation rules
        ];

        // Relax unique email validation for reupload
        $reuploadUserId = session('reupload_user_id');
        if ($reuploadUserId) {
            $userModel->setValidationRule('email', 'required|valid_email');
        }

        $userValid = $userModel->validate($userData);
        $addressValid = $addressModel->validate($addressData);

        // Age validation: only allow 15-30 years old (including those turning 15 within 1 month)
        $birthdate = $this->request->getPost('birthdate');
        $ageGroup = '';
        if ($birthdate) {
            $today = new \DateTime();
            $bdate = new \DateTime($birthdate);
            $age = $today->diff($bdate)->y;
            $months = $today->diff($bdate)->m;
            $days = $today->diff($bdate)->d;
            $isTurning15Soon = ($age === 14 && $months === 11 && $days >= 0) || ($age === 14 && $months === 10 && $days > 0);
            if ($age < 15 && !$isTurning15Soon) {
                session()->set('profiling_step', 2);
                session()->set('profile_data', $userData + ['region' => 'Region V', 'province' => 'Camarines Sur', 'municipality' => 'Iriga City', 'barangay' => $addressData['barangay'], 'zone_purok' => $addressData['zone_purok'], 'age_group' => $ageGroup]);
                return redirect()->back()->withInput()->with('validation_user', $userModel->validation)
                    ->with('age_error', 'Only users who are at least 15 years old (or turning 15 within 1 month) are allowed.');
            }
            if ($age > 30) {
                session()->set('profiling_step', 2);
                session()->set('profile_data', $userData + ['region' => 'Region V', 'province' => 'Camarines Sur', 'municipality' => 'Iriga City', 'barangay' => $addressData['barangay'], 'zone_purok' => $addressData['zone_purok'], 'age_group' => $ageGroup]);
                return redirect()->back()->withInput()->with('validation_user', $userModel->validation)
                    ->with('age_error', 'Only users aged between 15 to 30 years old are allowed.');
            }
            // Calculate age group
            if ($age >= 15 && $age <= 17) {
                $ageGroup = '1';
            } elseif ($age >= 18 && $age <= 24) {
                $ageGroup = '2';
            } elseif ($age >= 25 && $age <= 30) {
                $ageGroup = '3';
            }
        }

        if (!$userValid || !$addressValid) {
            session()->set('profiling_step', 2);
            session()->set('profile_data', $userData + ['region' => 'Region V', 'province' => 'Camarines Sur', 'municipality' => 'Iriga City', 'barangay' => $addressData['barangay'], 'zone_purok' => $addressData['zone_purok'], 'age_group' => $ageGroup]);
            return redirect()->back()->withInput()
                ->with('validation_user', $userModel->validation)
                ->with('validation_address', $addressModel->validation);
        }

        // Remove confirm_password before saving to session
        // unset($userData['confirm_password']);
        session()->set('profile_data', $userData + ['region' => 'Region V', 'province' => 'Camarines Sur', 'municipality' => 'Iriga City', 'barangay' => $addressData['barangay'], 'zone_purok' => $addressData['zone_purok'], 'age_group' => $ageGroup]);
        session()->set('profiling_step', 3);
        return redirect()->to(base_url('profiling'));
    }

    public function profilingStep2()
    {
        $profile = session('profile_data');
        if (!$profile) {
            return redirect()->to(base_url('profiling'));
        }
        
        $demo = [
            'civil_status' => $this->request->getPost('civil_status'),
            'youth_classification' => $this->request->getPost('youth_classification'),
            'age_group' => $this->request->getPost('age_group'),
            'work_status' => $this->request->getPost('work_status'),
            'educational_background' => $this->request->getPost('educational_background'),
            'sk_voter' => $this->request->getPost('sk_voter'),
            'sk_election' => $this->request->getPost('sk_election'),
            'national_voter' => $this->request->getPost('national_voter'),
            'kk_assembly' => $this->request->getPost('kk_assembly'),
            'how_many_times' => $this->request->getPost('how_many_times'),
            'no_why' => $this->request->getPost('no_why'),
        ];

        // Handle file uploads with validation
        $birthCertFile = $this->request->getFile('birth_certificate');
        $uploadIdFile = $this->request->getFile('upload_id');
        $certificatePath = FCPATH . 'uploads/certificate/';
        $idPath = FCPATH . 'uploads/id/';
        // Ensure directories exist
        if (!is_dir($certificatePath)) {
            mkdir($certificatePath, 0777, true);
        }
        if (!is_dir($idPath)) {
            mkdir($idPath, 0777, true);
        }
        $fileErrors = [];
        $allowedTypes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'
        ];
        $maxSize = 5 * 1024 * 1024; // 5MB

        // Validate and save birth certificate
        if ($birthCertFile && $birthCertFile->isValid() && !$birthCertFile->hasMoved()) {
            $fileName = $birthCertFile->getClientName();
            $fileSize = round($birthCertFile->getSize() / (1024 * 1024), 2); // Size in MB
            if (!in_array($birthCertFile->getMimeType(), $allowedTypes)) {
                $fileErrors['birth_certificate'] = "Invalid file type for '{$fileName}'. Allowed formats: JPG, PNG, GIF, WEBP, PDF.";
            } elseif ($birthCertFile->getSize() > $maxSize) {
                $fileErrors['birth_certificate'] = "Birth Certificate file '{$fileName}' is too large ({$fileSize} MB). Maximum allowed size is 5MB.";
            } else {
                $newName = 'birthcert_' . uniqid() . '.' . $birthCertFile->getExtension();
                $birthCertFile->move($certificatePath, $newName);
                $demo['birth_certificate'] = $newName;
            }
        } else {
            // Check if a file was attempted to be uploaded but failed
            if ($birthCertFile && $birthCertFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $fileName = $birthCertFile->getClientName() ?: 'Unknown file';
                $fileErrors['birth_certificate'] = "Failed to upload Birth Certificate '{$fileName}'. Please try again.";
            }
            // Always keep previous value if no new upload
            $prev = session('demographic_data')['birth_certificate'] ?? '';
            if (!empty($prev)) {
                $demo['birth_certificate'] = $prev;
            }
        }

        // Validate and save upload id
        if ($uploadIdFile && $uploadIdFile->isValid() && !$uploadIdFile->hasMoved()) {
            $fileName = $uploadIdFile->getClientName();
            $fileSize = round($uploadIdFile->getSize() / (1024 * 1024), 2); // Size in MB
            if (!in_array($uploadIdFile->getMimeType(), $allowedTypes)) {
                $fileErrors['upload_id'] = "Invalid file type for '{$fileName}'. Allowed formats: JPG, PNG, GIF, WEBP, PDF.";
            } elseif ($uploadIdFile->getSize() > $maxSize) {
                $fileErrors['upload_id'] = "Valid ID file '{$fileName}' is too large ({$fileSize} MB). Maximum allowed size is 5MB.";
            } else {
                $newName = 'idpic_' . uniqid() . '.' . $uploadIdFile->getExtension();
                $uploadIdFile->move($idPath, $newName);
                $demo['upload_id'] = $newName;
            }
        } else {
            // Check if a file was attempted to be uploaded but failed
            if ($uploadIdFile && $uploadIdFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $fileName = $uploadIdFile->getClientName() ?: 'Unknown file';
                $fileErrors['upload_id'] = "Failed to upload Valid ID '{$fileName}'. Please try again.";
            }
            $prev = session('demographic_data')['upload_id'] ?? '';
            if (!empty($prev)) {
                $demo['upload_id'] = $prev;
            }
        }

        $userExtInfoModel = new UserExtInfoModel();

        if (!empty($fileErrors) || !$userExtInfoModel->validate($demo)) {
            session()->set('profiling_step', 3);
            session()->set('demographic_data', $demo);
            return redirect()->back()->withInput()
                ->with('validation', $userExtInfoModel->validation)
                ->with('file_errors', $fileErrors);
        }

        // Require both files to be present (either uploaded now or already in session)
        if (empty($demo['birth_certificate'])) {
            $fileErrors['birth_certificate'] = 'Birth Certificate is required.';
        }
        if (empty($demo['upload_id'])) {
            $fileErrors['upload_id'] = 'Valid ID is required.';
        }

        if (!empty($fileErrors)) {
            session()->set('profiling_step', 3);
            session()->set('demographic_data', $demo);
            return redirect()->back()->withInput()
                ->with('file_errors', $fileErrors);
        }

        // Save demographic data to session and go to step 4 (account)
        session()->set('demographic_data', $demo);
        session()->set('profiling_step', 4);
        return redirect()->to(base_url('profiling'));
    }

    public function profilingStep3()
    {
        $account = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'confirm_password' => $this->request->getPost('confirm_password'),
        ];
        $userModel = new UserModel();
        $validation = \Config\Services::validation();
        $reuploadUserId = session('reupload_user_id');
        $validationMessages = [
            'password' => [
                'required' => 'The Password field is required.'
            ],
            'confirm_password' => [
                'required' => 'The Confirm Password field is required.',
                'matches' => 'The Confirm Password field does not match the password field.'
            ]
        ];
        // --- Profile Picture Upload Logic ---
        $profilePictureFile = $this->request->getFile('profile_picture');
        $profilePicPath = FCPATH . 'uploads/profile_pictures/';
        if (!is_dir($profilePicPath)) {
            mkdir($profilePicPath, 0777, true);
        }
        $fileError = '';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        $profile_picture = '';
        if ($profilePictureFile && $profilePictureFile->isValid() && !$profilePictureFile->hasMoved()) {
            $fileName = $profilePictureFile->getClientName();
            $fileSize = round($profilePictureFile->getSize() / (1024 * 1024), 2); // Size in MB
            if (!in_array($profilePictureFile->getMimeType(), $allowedTypes)) {
                $fileError = "Invalid file type for '{$fileName}'. Allowed formats: JPG, PNG, WEBP.";
            } elseif ($profilePictureFile->getSize() > $maxSize) {
                $fileError = "Profile Picture '{$fileName}' is too large ({$fileSize} MB). Maximum allowed size is 5MB.";
            } else {
                $newName = 'profilepic_' . uniqid() . '.' . $profilePictureFile->getExtension();
                $profilePictureFile->move($profilePicPath, $newName);
                $profile_picture = $newName;
            }
        } else {
            // Check if a file was attempted to be uploaded but failed
            if ($profilePictureFile && $profilePictureFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $fileName = $profilePictureFile->getClientName() ?: 'Unknown file';
                $fileError = "Failed to upload Profile Picture '{$fileName}'. Please try again.";
            }
            $prev = session('account_data')['profile_picture'] ?? '';
            if (!empty($prev)) {
                $profile_picture = $prev;
            }
        }
        // --- End Profile Picture Upload Logic ---
        if ($reuploadUserId) {
            $validation->setRules([
                'username' => 'required|min_length[4]|max_length[30]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]',
            ], $validationMessages);
        } else {
            $validation->setRules([
                'username' => 'required|min_length[4]|max_length[30]|is_unique[user.username]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]',
            ], $validationMessages);
        }
        // Validate profile picture required (only for new users or if no previous picture exists)
        if (empty($profile_picture) && !$reuploadUserId) {
            $fileError = 'Profile picture is required.';
        }
        if (!$validation->run($account) || !empty($fileError)) {
            session()->set('profiling_step', 4);
            $account['profile_picture'] = $profile_picture;
            session()->set('account_data', $account);
            // Pass errors as array for the view
            return redirect()->back()->withInput()
                ->with('validation_account_errors', $validation->getErrors())
                ->with('file_errors', ['profile_picture' => $fileError]);
        }
        // Save profile_picture to account_data in session
        $account['profile_picture'] = $profile_picture;
        session()->set('account_data', $account);
        session()->set('profiling_step', 5);
        return redirect()->to(base_url('profiling'));
    }

    public function backToStep2()
    {
        // Retain profile data and go back to step 2 (profile)
        $profile = session('profile_data') ?? [];
        session()->set('profiling_step', 2);
        session()->set('profile_data', $profile);
        return redirect()->to(base_url('profiling'))->withInput();
    }

    public function backToStep3()
    {
        // Retain demographic data and go back to step 3 (demographic)
        $demo = session('demographic_data') ?? [];
        session()->set('profiling_step', 3);
        session()->set('demographic_data', $demo);
        
        return redirect()->to(base_url('profiling'))->withInput();
    }

    public function backToStep4()
    {
        // Retain account data (including profile picture) when going back to step 4
        $account = session('account_data') ?? [
            'username' => '',
            'password' => '',
            'confirm_password' => '',
            'profile_picture' => ''
        ];
        $demo = session('demographic_data') ?? [];
        
        session()->set('profiling_step', 4);
        session()->set('account_data', $account);
        session()->set('demographic_data', $demo);
        
        return redirect()->to(base_url('profiling'))->withInput();
    }

    public function profilingSubmit()
    {
        $profile = session('profile_data');
        $demographic = session('demographic_data');
        $account = session('account_data');
        if (!$profile || !$demographic || !$account) {
            return redirect()->to(base_url('profiling'));
        }
        $userModel = new UserModel();
        $addressModel = new AddressModel();
        $userExtInfoModel = new UserExtInfoModel();
        $reuploadUserId = session('reupload_user_id');
        if ($reuploadUserId) {
            // Update existing user
            $userData = [
                'first_name' => $profile['first_name'],
                'middle_name' => $profile['middle_name'],
                'last_name' => $profile['last_name'],
                'suffix' => $profile['suffix'],
                'birthdate' => $profile['birthdate'],
                'sex' => $profile['sex'],
                'email' => $profile['email'],
                'phone_number' => $profile['phone_number'],
                'username' => $account['username'],
                'password' => password_hash($account['password'], PASSWORD_DEFAULT),
                'user_type' => 1,
                'is_active' => 1,
                'status' => 1, // Set status to 1 (pending) after successful re-upload
            ];
            
            // Skip validation for re-upload updates to avoid unique constraint issues
            $userModel->skipValidation(true);
            $updateResult = $userModel->update($reuploadUserId, $userData);
            $userModel->skipValidation(false); // Reset validation
            
            if (!$updateResult) {
                log_message('error', 'Failed to update user status for re-upload. User ID: ' . $reuploadUserId);
                // Try to update just the status if full update fails
                $userModel->skipValidation(true);
                $statusUpdateResult = $userModel->update($reuploadUserId, ['status' => 1]);
                $userModel->skipValidation(false);
                if (!$statusUpdateResult) {
                    log_message('error', 'Failed to update user status even with minimal update. User ID: ' . $reuploadUserId);
                }
            }
            $addressData = [
                'region' => '1', // Always save as ID 1 for Region V
                'province' => '1', // Always save as ID 1 for Camarines Sur  
                'municipality' => '1', // Always save as ID 1 for Iriga City
                'barangay' => $profile['barangay'],
                'zone_purok' => $profile['zone_purok'],
            ];
            $addressExists = $addressModel->where('user_id', $reuploadUserId)->first();
            if ($addressExists) {
                $addressModel->update($reuploadUserId, $addressData);
            } else {
                $addressData['user_id'] = $reuploadUserId;
                $addressModel->insert($addressData);
            }
            $extInfoData = [
                'civil_status' => $demographic['civil_status'],
                'youth_classification' => $demographic['youth_classification'],
                'age_group' => $demographic['age_group'],
                'work_status' => $demographic['work_status'],
                'educational_background' => $demographic['educational_background'],
                'sk_voter' => $demographic['sk_voter'],
                'sk_election' => $demographic['sk_election'],
                'national_voter' => $demographic['national_voter'],
                'kk_assembly' => $demographic['kk_assembly'],
                'how_many_times' => $demographic['how_many_times'],
                'no_why' => $demographic['no_why'],
                'birth_certificate' => $demographic['birth_certificate'] ?? '',
                'upload_id' => $demographic['upload_id'] ?? '',
                'profile_picture' => $account['profile_picture'] ?? '',
            ];
            $extInfoExists = $userExtInfoModel->where('user_id', $reuploadUserId)->first();
            if ($extInfoExists) {
                $userExtInfoModel->update($reuploadUserId, $extInfoData);
            } else {
                $extInfoData['user_id'] = $reuploadUserId;
                $userExtInfoModel->insert($extInfoData);
            }
            session()->remove('reupload_user_id');
            // Clear all profiling session data
            session()->remove('profile_data');
            session()->remove('profiling_step');
            session()->remove('demographic_data');
            session()->remove('account_data');
            // Redirect to login with success message for re-upload
            return redirect()->to(base_url('login?reupload_success=1'));
        } else {
            $userData = [
                'first_name' => $profile['first_name'],
                'middle_name' => $profile['middle_name'],
                'last_name' => $profile['last_name'],
                'suffix' => $profile['suffix'],
                'birthdate' => $profile['birthdate'],
                'sex' => $profile['sex'],
                'email' => $profile['email'],
                'phone_number' => $profile['phone_number'],
                'username' => $account['username'],
                'password' => password_hash($account['password'], PASSWORD_DEFAULT),
                'user_type' => 1,
                'is_active' => 1,
                'status' => 1,
            ];
            $lastUser = $userModel->orderBy('id', 'DESC')->first();
            $newId = $lastUser ? $lastUser['id'] + 1 : 1;
            $userData['id'] = $newId;
            $userModel->insert($userData);
            $addressModel->insert([
                'user_id' => $newId,
                'region' => '1', // Always save as ID 1 for Region V
                'province' => '1', // Always save as ID 1 for Camarines Sur
                'municipality' => '1', // Always save as ID 1 for Iriga City
                'barangay' => $profile['barangay'],
                'zone_purok' => $profile['zone_purok'],
            ]);
            $userExtInfoModel->insert([
                'user_id' => $newId,
                'civil_status' => $demographic['civil_status'],
                'youth_classification' => $demographic['youth_classification'],
                'age_group' => $demographic['age_group'],
                'work_status' => $demographic['work_status'],
                'educational_background' => $demographic['educational_background'],
                'sk_voter' => $demographic['sk_voter'],
                'sk_election' => $demographic['sk_election'],
                'national_voter' => $demographic['national_voter'],
                'kk_assembly' => $demographic['kk_assembly'],
                'how_many_times' => $demographic['how_many_times'],
                'no_why' => $demographic['no_why'],
                'birth_certificate' => $demographic['birth_certificate'] ?? '',
                'upload_id' => $demographic['upload_id'] ?? '',
                'profile_picture' => $account['profile_picture'] ?? '',
            ]);
            // Clear all profiling session data
            session()->remove('profile_data');
            session()->remove('profiling_step');
            session()->remove('demographic_data');
            session()->remove('account_data');
            // Redirect to login with success message for new registration
            return redirect()->to(base_url('login?registration_success=1'));
        }
    }

    public function backToStep1()
    {
        // Save current Step 2 data to session
        $demo = [
            'civil_status' => $this->request->getPost('civil_status'),
            'youth_classification' => $this->request->getPost('youth_classification'),
            'age_group' => $this->request->getPost('age_group'),
            'work_status' => $this->request->getPost('work_status'),
            'educational_background' => $this->request->getPost('educational_background'),
            'sk_voter' => $this->request->getPost('sk_voter'),
            'sk_election' => $this->request->getPost('sk_election'),
            'national_voter' => $this->request->getPost('national_voter'),
            'kk_assembly' => $this->request->getPost('kk_assembly'),
            'how_many_times' => $this->request->getPost('how_many_times'),
            'no_why' => $this->request->getPost('no_why'),
        ];
        session()->set('demographic_data', $demo);
        session()->set('profiling_step', 1);
        return redirect()->to(base_url('profiling'))->withInput();
    }

    public function reuploadById($userId)
    {
        $userExtInfoModel = new UserExtInfoModel();
        $userModel = new UserModel();
        $addressModel = new AddressModel();

        $user = $userModel->find($userId);
        $ext = $userExtInfoModel->find($userId);
        $address = $addressModel->where('user_id', $userId)->first();

        if (!$user || !$ext || !$address) {
            return redirect()->to(base_url('profiling'))->with('error', 'User data not found.');
        }

        // Prepare session data for each step
        $profile_data = [
            'first_name' => $user['first_name'],
            'middle_name' => $user['middle_name'],
            'last_name' => $user['last_name'],
            'suffix' => $user['suffix'],
            'birthdate' => $user['birthdate'],
            'sex' => $user['sex'],
            'email' => $user['email'],
            'phone_number' => $user['phone_number'],
            'region' => 'Region V', // Always display as Region V
            'province' => 'Camarines Sur', // Always display as Camarines Sur
            'municipality' => 'Iriga City', // Always display as Iriga City
            'barangay' => $address['barangay'] ?? '',
            'zone_purok' => $address['zone_purok'] ?? '',
            'age_group' => $ext['age_group'] ?? '',
        ];
        $demographic_data = [
            'civil_status' => $ext['civil_status'] ?? '',
            'youth_classification' => $ext['youth_classification'] ?? '',
            'age_group' => $ext['age_group'] ?? '',
            'work_status' => $ext['work_status'] ?? '',
            'educational_background' => $ext['educational_background'] ?? '',
            'sk_voter' => $ext['sk_voter'] ?? '',
            'sk_election' => $ext['sk_election'] ?? '',
            'national_voter' => $ext['national_voter'] ?? '',
            'kk_assembly' => $ext['kk_assembly'] ?? '',
            'how_many_times' => $ext['how_many_times'] ?? '',
            'no_why' => $ext['no_why'] ?? '',
            'birth_certificate' => $ext['birth_certificate'] ?? '',
            'upload_id' => $ext['upload_id'] ?? '',
            'profile_picture' => $ext['profile_picture'] ?? '',
        ];
        $account_data = [
            'username' => $user['username'],
            'password' => '',
            'confirm_password' => '',
            'profile_picture' => $ext['profile_picture'] ?? '',
        ];

        // Status will be set to 1 (pending) only after completing the profiling process

        session()->set('profile_data', $profile_data);
        session()->set('demographic_data', $demographic_data);
        session()->set('account_data', $account_data);
        session()->set('profiling_step', 1);
        session()->set('reupload_user_id', $userId);
        
        return redirect()->to(base_url('profiling'));
    }
}
