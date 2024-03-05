<?php

namespace App\Rules;

use libphonenumber\PhoneNumberUtil;
use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        
        try {
            $phoneNumber = $phoneUtil->parse($value, null);
            return $phoneUtil->isValidNumber($phoneNumber);
        } catch (\libphonenumber\NumberParseException $e) {
            return false;
        }
    }

    public function message()
    {
        return 'The :attribute is not a valid phone number.';
    }
}
