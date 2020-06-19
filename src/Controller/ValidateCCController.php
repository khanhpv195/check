<?php

namespace Src\Controller;

use \Firebase\JWT\JWT;

class  ValidateCCController
{
    protected $creditNumber;

    protected $cvvNumber;

    protected $email;

    protected $expirationDate;

    protected $phone;

    /**
     * @param $number
     * @return bool
     */
    public function lundAgothim($number)
    {
        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $number = preg_replace('/\D/', '', $number);

        // Set the string length and parity
        $number_length = strlen($number);
        $parity = $number_length % 2;

        // Loop through each digit and do the maths
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];
            // Multiply alternate digits by two
            if ($i % 2 == $parity) {
                $digit *= 2;
                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            // Total up the digits
            $total += $digit;
        }
        // If the total mod 10 equals 0, the number is valid
        return ($total % 10 == 0) ? true : false;
    }

    public static function required($data)
    {

    }

    /**
     * @param $email
     * @return bool
     */
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePhone($phone)
    {

    }

    public static function validateCCV($ccv)
    {
        $regex = '/^[0-9]{3,4}$/';
    }


    /**
     * @param ValidateCCController $libValidate
     * @param $cc
     * @return bool
     */
    public function validateCC(ValidateCCController $libValidate, $cc)
    {
        return $libValidate->lundAgothim($cc);
    }

}