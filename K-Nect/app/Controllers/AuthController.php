<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserExtInfoModel;
use App\Models\AddressModel;

class AuthController extends BaseController
{
    public function loginProcess()
    {
        $userExtInfoModel = new UserExtInfoModel();
        $userModel = new UserModel();

        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $isAjax = $this->request->isAJAX();

        // Try KK Member (username/email + password)
        $user = $userModel->where('username', $login)->orWhere('email', $login)->first();
        if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
            if ($user['status'] == 3) {
                $extInfo = $userExtInfoModel->where('user_id', $user['id'])->first();
                $reason = isset($extInfo['reason']) && $extInfo['reason'] !== '' ? $extInfo['reason'] : 'No reason provided.';
                if ($isAjax) {
                    return $this->response->setJSON([
                        'success' => false,
                        'type' => 'rejected',
                        'message' => 'Your account has been rejected.',
                        'reason' => $reason,
                        'user_id' => $user['id']
                    ]);
                } else {
                    return redirect()->to('login')->with('error', 'Your account has been rejected. Reason: ' . $reason);
                }
            }
            if ($user['status'] == 1) {
                if ($isAjax) {
                    return $this->response->setJSON([
                        'success' => false,
                        'type' => 'pending',
                        'message' => 'Your account is not yet approved. Please wait for approval.'
                    ]);
                } else {
                    return redirect()->to('login')->with('error', 'Your account is not yet approved.');
                }
            } else if ($user['status'] == 2) {
                $session = session();
                $session->set('user_id', $user['user_id']); // Use the permanent user_id field
                $session->set('username', $user['username']);
                if ($isAjax) {
                    return $this->response->setJSON([
                        'success' => true,
                        'redirect' => base_url('kk/dashboard')
                    ]);
                } else {
                    return redirect()->to('kk/dashboard');
                }
            }
        }

        // Try SK Official (sk_username + sk_password)
        $user = $userModel->where('sk_username', $login)->first();
        if ($user && isset($user['sk_password'])) {
            $skPassword = $user['sk_password'];
            $isHashed = strlen($skPassword) === 60 && preg_match('/^\$2y\$/', $skPassword); // bcrypt hash check
            $valid = false;
            if ($isHashed) {
                $valid = password_verify($password, $skPassword);
            } else {
                $valid = ($password === $skPassword);
            }
            if ($valid) {
                // Check if password needs to be changed (not hashed yet)
                if (!$isHashed) {
                    // Store temporary session data for password change
                    $session = session();
                    $session->setTempdata('temp_user_id', $user['id'], 300); // 5 minutes
                    $session->setTempdata('temp_user_type', 'sk', 300);
                    $session->setTempdata('temp_username', $user['sk_username'], 300);
                    $session->setTempdata('temp_permanent_id', $user['user_id'], 300);
                    
                    // Get user's barangay information for SK officials
                    $addressModel = new AddressModel();
                    $address = $addressModel->where('user_id', $user['id'])->first();
                    if ($address) {
                        $session->setTempdata('temp_sk_barangay', $address['barangay'], 300);
                    }
                    
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => true,
                            'redirect' => base_url('change-password')
                        ]);
                    } else {
                        return redirect()->to('change-password');
                    }
                }
                
                if ($user['status'] == 3) {
                    $extInfo = $userExtInfoModel->where('user_id', $user['id'])->first();
                    $reason = isset($extInfo['reason']) && $extInfo['reason'] !== '' ? $extInfo['reason'] : 'No reason provided.';
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => false,
                            'type' => 'rejected',
                            'message' => 'Your account has been rejected.',
                            'reason' => $reason,
                            'user_id' => $user['id']
                        ]);
                    } else {
                        return redirect()->to('login')->with('error', 'Your account has been rejected. Reason: ' . $reason);
                    }
                }
                if ($user['status'] == 1) {
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => false,
                            'type' => 'pending',
                            'message' => 'Your account is not yet approved. Please wait for approval.'
                        ]);
                    } else {
                        return redirect()->to('login')->with('error', 'Your account is not yet approved.');
                    }
                } else if ($user['status'] == 2) {
                    $session = session();
                    $session->set('user_id', $user['user_id']); // Use the permanent user_id field
                    $session->set('username', $user['sk_username']);
                    
                    // Get user's barangay information for SK officials
                    $addressModel = new AddressModel();
                    $address = $addressModel->where('user_id', $user['id'])->first();
                    if ($address) {
                        $session->set('sk_barangay', $address['barangay']);
                    }
                    
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => true,
                            'redirect' => base_url('sk/dashboard')
                        ]);
                    } else {
                        return redirect()->to('sk/dashboard');
                    }
                } else {
                    // Handle other status values
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => false,
                            'type' => 'invalid_status',
                            'message' => 'Your account status is invalid. Please contact administrator.'
                        ]);
                    } else {
                        return redirect()->to('login')->with('error', 'Your account status is invalid. Please contact administrator.');
                    }
                }
            }
        }

        // Try Pederasyon Officer (ped_username + ped_password)
        $user = $userModel->where('ped_username', $login)->first();
        if ($user && isset($user['ped_password'])) {
            $pedPassword = $user['ped_password'];
            $isHashed = strlen($pedPassword) === 60 && preg_match('/^\$2y\$/', $pedPassword); // bcrypt hash check
            $valid = false;
            if ($isHashed) {
                $valid = password_verify($password, $pedPassword);
            } else {
                $valid = ($password === $pedPassword);
            }
            if ($valid) {
                // Check if password needs to be changed (not hashed yet)
                if (!$isHashed) {
                    // Store temporary session data for password change
                    $session = session();
                    $session->setTempdata('temp_user_id', $user['id'], 300); // 5 minutes
                    $session->setTempdata('temp_user_type', 'pederasyon', 300);
                    $session->setTempdata('temp_username', $user['ped_username'], 300);
                    $session->setTempdata('temp_permanent_id', $user['user_id'], 300);
                    
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => true,
                            'redirect' => base_url('change-password')
                        ]);
                    } else {
                        return redirect()->to('change-password');
                    }
                }
                if ($user['status'] == 3) {
                    $extInfo = $userExtInfoModel->where('user_id', $user['id'])->first();
                    $reason = isset($extInfo['reason']) && $extInfo['reason'] !== '' ? $extInfo['reason'] : 'No reason provided.';
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => false,
                            'type' => 'rejected',
                            'message' => 'Your account has been rejected.',
                            'reason' => $reason,
                            'user_id' => $user['id']
                        ]);
                    } else {
                        return redirect()->to('login')->with('error', 'Your account has been rejected. Reason: ' . $reason);
                    }
                }
                if ($user['status'] == 1) {
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => false,
                            'type' => 'pending',
                            'message' => 'Your account is not yet approved. Please wait for approval.'
                        ]);
                    } else {
                        return redirect()->to('login')->with('error', 'Your account is not yet approved.');
                    }
                } else if ($user['status'] == 2) {
                    $session = session();
                    $session->set('user_id', $user['user_id']); // Use the permanent user_id field
                    $session->set('username', $user['ped_username']);
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => true,
                            'redirect' => base_url('pederasyon/dashboard')
                        ]);
                    } else {
                        return redirect()->to('pederasyon/dashboard');
                    }
                } else {
                    // Handle other status values
                    if ($isAjax) {
                        return $this->response->setJSON([
                            'success' => false,
                            'type' => 'invalid_status',
                            'message' => 'Your account status is invalid. Please contact administrator.'
                        ]);
                    } else {
                        return redirect()->to('login')->with('error', 'Your account status is invalid. Please contact administrator.');
                    }
                }
            }
        }

        // If all fail
        if ($isAjax) {
            return $this->response->setJSON([
                'success' => false,
                'type' => 'invalid',
                'message' => 'Invalid username or password.'
            ]);
        } else {
            return redirect()->to('login')->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }

    public function changePassword()
    {
        $session = session();
        
        // Check if user has temporary session data
        if (!$session->getTempdata('temp_user_id') || !$session->getTempdata('temp_user_type')) {
            return redirect()->to('login')->with('error', 'Session expired. Please login again.');
        }
        
        $data = [
            'user_type' => $session->getTempdata('temp_user_type'),
            'username' => $session->getTempdata('temp_username')
        ];
        
        return view('K-NECT/change_password', $data);
    }

    public function changePasswordProcess()
    {
        $session = session();
        $userModel = new UserModel();
        
        // Check if user has temporary session data
        if (!$session->getTempdata('temp_user_id') || !$session->getTempdata('temp_user_type')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Session expired. Please login again.'
                ]);
            }
            return redirect()->to('login')->with('error', 'Session expired. Please login again.');
        }
        
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');
        $isAjax = $this->request->isAJAX();
        
        // Validation
        if (empty($newPassword) || empty($confirmPassword)) {
            $message = 'All fields are required.';
            if ($isAjax) {
                return $this->response->setJSON(['success' => false, 'message' => $message]);
            }
            return redirect()->back()->with('error', $message);
        }
        
        if (strlen($newPassword) < 6) {
            $message = 'Password must be at least 6 characters long.';
            if ($isAjax) {
                return $this->response->setJSON(['success' => false, 'message' => $message]);
            }
            return redirect()->back()->with('error', $message);
        }
        
        if ($newPassword !== $confirmPassword) {
            $message = 'Passwords do not match.';
            if ($isAjax) {
                return $this->response->setJSON(['success' => false, 'message' => $message]);
            }
            return redirect()->back()->with('error', $message);
        }
        
        // Get temporary data
        $tempUserId = $session->getTempdata('temp_user_id');
        $tempUserType = $session->getTempdata('temp_user_type');
        $tempUsername = $session->getTempdata('temp_username');
        $tempPermanentId = $session->getTempdata('temp_permanent_id');
        $tempSkBarangay = $session->getTempdata('temp_sk_barangay');
        
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update the password based on user type
        if ($tempUserType === 'sk') {
            $userModel->update($tempUserId, ['sk_password' => $hashedPassword]);
            $dashboardUrl = 'sk/dashboard';
        } else if ($tempUserType === 'pederasyon') {
            $userModel->update($tempUserId, ['ped_password' => $hashedPassword]);
            $dashboardUrl = 'pederasyon/dashboard';
        }
        
        // Clear temporary data and set permanent session
        $session->removeTempdata('temp_user_id');
        $session->removeTempdata('temp_user_type');
        $session->removeTempdata('temp_username');
        $session->removeTempdata('temp_permanent_id');
        $session->removeTempdata('temp_sk_barangay');
        $session->set('user_id', $tempPermanentId);
        $session->set('username', $tempUsername);
        
        // Set barangay information for SK users
        if ($tempUserType === 'sk' && $tempSkBarangay) {
            $session->set('sk_barangay', $tempSkBarangay);
        }
        
        if ($isAjax) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Password changed successfully!',
                'redirect' => base_url($dashboardUrl)
            ]);
        }
        
        return redirect()->to($dashboardUrl)->with('success', 'Password changed successfully!');
    }

    // Temporary debug method - REMOVE IN PRODUCTION
    public function debugUser()
    {
        $userModel = new UserModel();
        $login = $this->request->getGet('login');
        
        if (!$login) {
            return $this->response->setJSON(['error' => 'Please provide login parameter']);
        }
        
        // Check for SK user
        $skUser = $userModel->where('sk_username', $login)->first();
        $pedUser = $userModel->where('ped_username', $login)->first();
        $kkUser = $userModel->where('username', $login)->orWhere('email', $login)->first();
        
        return $this->response->setJSON([
            'search_term' => $login,
            'sk_user_found' => $skUser ? true : false,
            'sk_user_data' => $skUser ? [
                'id' => $skUser['id'],
                'sk_username' => $skUser['sk_username'],
                'status' => $skUser['status'],
                'sk_password_length' => strlen($skUser['sk_password'] ?? ''),
                'sk_password_preview' => substr($skUser['sk_password'] ?? '', 0, 10) . '...'
            ] : null,
            'ped_user_found' => $pedUser ? true : false,
            'ped_user_data' => $pedUser ? [
                'id' => $pedUser['id'],
                'ped_username' => $pedUser['ped_username'],
                'status' => $pedUser['status'],
                'ped_password_length' => strlen($pedUser['ped_password'] ?? ''),
                'ped_password_preview' => substr($pedUser['ped_password'] ?? '', 0, 10) . '...'
            ] : null,
            'kk_user_found' => $kkUser ? true : false,
            'kk_user_data' => $kkUser ? [
                'id' => $kkUser['id'],
                'username' => $kkUser['username'],
                'email' => $kkUser['email'],
                'status' => $kkUser['status']
            ] : null
        ]);
    }
}
