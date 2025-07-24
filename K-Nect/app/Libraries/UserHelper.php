<?php

namespace App\Libraries;

use App\Models\UserModel;

class UserHelper
{
    public static function generateUnique6DigitId()
    {
        $userModel = new UserModel();
        do {
            $id = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $exists = $userModel->where('user_id', $id)->first();
        } while ($exists);
        return $id;
    }

    public static function generateSKUsername($firstName, $lastName)
    {
        return 'SK_' . ucfirst(str_replace(' ', '', $firstName)) . ucfirst(str_replace(' ', '', $lastName));
    }
    
    public static function generateSecretaryUsername($firstName, $lastName)
    {
        return 'SEC_' . ucfirst(str_replace(' ', '', $firstName)) . ucfirst(str_replace(' ', '', $lastName));
    }
    
    public static function generatePEDUsername($firstName, $lastName)
    {
        return 'PED_' . ucfirst(str_replace(' ', '', $firstName)) . ucfirst(str_replace(' ', '', $lastName));
    }

    public static function generatePassword($length = 8)
    {
        return bin2hex(random_bytes($length/2));
    }

    public static function generateUniqueUsername($prefix = 'user')
    {
        return $prefix . '_' . bin2hex(random_bytes(3)) . time();
    }
}
