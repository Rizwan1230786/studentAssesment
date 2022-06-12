<?php

/*
| -----------------------------------------------------
| PRODUCT NAME: Inflix.edu - School Management System
| -----------------------------------------------------
| AUTHORS: CODETHEMES & ONEZEROART TEAM
| -----------------------------------------------------
| EMAIL: support@onezeroart.com
| -----------------------------------------------------
| COPYRIGHT: RESERVED BY PIXELCODER.NET & ONEZEROART.COM
| -----------------------------------------------------
| DESIGNED BY: https://themeforest.net/user/codethemes/portfolio
| -----------------------------------------------------
| DEVELOPED BY: https://codecanyon.net/user/onezeroart/portfolio
| -----------------------------------------------------
| WEBSITE: PIXELCODER.NET & ONEZEROART.COM
| -----------------------------------------------------
*/

namespace App\Envato;

class Envato {
    // Bearer, no need for OAUTH token, change this to your bearer string
    // https://build.envato.com/api/#token
    //private static $bearer = "hTl89YLIDJqra1orJvkasA5ojJg9GUgg";
    //private static $bearer = "Ui2Tiq2JyKNh7nNRb1uBrEKYujKyBBhv";
    //private static $bearer = "TWw4qSHF0lKdvOrwtdzfEEbWe6Y7f0fz";
    //private key = 86xhsg2lrqzpahe4odzrp3e0bnnm5ung
    private static $bearer = "KmUlbULx0axuyoeRXGy6c3ZYRm8sDGdS";

    static function getPurchaseData($code) {

   $bearer   = 'bearer ' . self::$bearer;
      $header   = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json; charset=utf-8';
      $header[] = 'Authorization: ' . $bearer;
      
      $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$code.'.json';
      $ch_verify = curl_init( $verify_url . '?code=' . $code );
      
      curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
      curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
      curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      
      $cinit_verify_data = curl_exec( $ch_verify );
      curl_close( $ch_verify );
      
      if ($cinit_verify_data != "")    
        return json_decode($cinit_verify_data,true);  
      else
        return false;

    }

    static function verifyPurchase($code) {
      $verify_obj = self::getPurchaseData($code);
      return $verify_obj;

    }





  }

?>
