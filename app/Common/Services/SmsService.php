<?php
namespace App\Common\Services;
use \Shipu\MuthoFun\Facades\MuthoFun;

use Twilio\Rest\Client;

require base_path().'/app/Common/Services/twilio-php-master/Twilio/autoload.php';

class SmsService
{
    function __construct()
    {
        $this->sms_enabled   = true;
    }

    public function send_sms($message,$to_number)
    {
        // Find your Account Sid and Auth Token at twilio.com/console
        // DANGER! This is insecure. See http://twil.io/secure
/*dump($message);
dd($to_number);*/
        try{
            $sid    = "AC520565cdb11362a1089b5514cb53f807";
            $token  = "1857a1ba6807f209be8ae7157fad95f9";

            $twilio = new Client($sid, $token);
        
            $message = $twilio->messages
                                ->create($to_number, // to
                                    array(
                                       "body" => $message,
                                       //"from" => "+13475719238"
                                       "from" => "+13475719238"
                                       //"from" => "+15005550000"
                                    )
                                );

            //print($message->sid);
            
            return true;
        }
        catch(\Exception $e){
            
            return false;
        }
    }
}

?>