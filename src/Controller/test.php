<?php
class ValidateCCController {
/**
* @param $number
* @return bool
*/
protected  $creditNumber;

protected  $cvvNumber;

protected  $email;

protected  $expirationDate;

protected  $phone;


//    public function __construct(array $info)
//    {
//        if(!empty($info)) {
//            foreach ($info as $variable => $data) {
//                $this->$variable = $data;
//            }
//        }
//    }

public function luhn_check($number) {
// Strip any non-digits (useful for credit card numbers with spaces and hyphens)
$number=preg_replace('/\D/', '', $number);

// Set the string length and parity
$number_length=strlen($number);
$parity=$number_length % 2;

// Loop through each digit and do the maths
$total=0;
for ($i=0; $i<$number_length; $i++) {
$digit=$number[$i];
// Multiply alternate digits by two
if ($i % 2 == $parity) {
$digit*=2;
// If the sum is two digits, add them together (in effect)
if ($digit > 9) {
$digit-=9;
}
}
// Total up the digits
$total+=$digit;
}

// If the total mod 10 equals 0, the number is valid
return  ($total % 10 == 0) ? true : false;

}

/**
* @param $creditNumber
* @param $cvvNumber
* @param $email
* @param $expiration_date
* @param $phone
* @return bool
*/
//    function validateCard(){
//        $header_content_type =  $_SERVER["CONTENT_TYPE"];
//        $mess = null;
//        if(strlen((string)$this->cvvNumber) < 1){
//            $mess = 'Cvv is required';
//        }
//        if(strlen((string)$this->creditNumber) < 1){
//            $mess = 'Credit Card is required';
//        }
//        if(strlen((string)$this->email) < 1){
//            $mess = 'Email is required';
//        }
//        if(strlen((string)$this->expirationDate) < 1){
//            $mess = 'Expiration date is required';
//        }
//        if(strlen((string)$this->phone) < 1){
//            $mess = 'Phone is required';
//
//        }
//
//        if(empty($cvvNumber) || empty($creditNumber) || empty($email) || empty($expiration_date) || empty($phone)){
//            $response = array(
//                'err' => 1,
//                'message' => $mess,
//            );
//            echo json_encode($response);
//            return false;
//        }
//        $validateCredit = $this->luhn_check($creditNumber);
//        if($validateCredit === true){
//            return $this->reponseData();
//        }
//        return $this->reponseData([
//            'message' => $mess
//        ], false);
//
//    }
//
//    public function reponseData($data = [], $status = true)
//    {
//        return [
//            'status' => $status,
//            'data' => $data
//        ];
//    }
}

class Validate {
        protected  $creditNumber;

        protected  $cvvNumber;

        protected  $email;

        protected  $expirationDate;

        protected  $phone;

        public static function required($data)
        {

        }

        public static function validateEmail($email)
        {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        public static function validatePhone($phone)
        {

        }

        public static function validateCCV($ccv)
        {
        $regex =  '/^[0-9]{3,4}$/' ;
        }

        public static function validateCC(ValidateCCController $libValidate, $cc)
        {
        return $libValidate->luhn_check($cc);
}

}


$result = new Validate();
//$result->luhn_check(161454645546546);
$response = $result->validateCC([
'creditNumber' => $this->creditNumber,
'cvvNumber' => $this->cvvNumber,
'email' => $this->email,
'expirationDate' => $this->expirationDate,
'phone' => $this->phone
]);