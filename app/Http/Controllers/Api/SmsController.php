<?php

namespace App\Http\Controllers\Api;

use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        $userToken = UserToken::where('token', $request->token)->first();
    	if ($userToken->status == 0) {
    		echo "The key is not Active at the moment";
    	}else{
    		$user = $userToken->user;
    		if(!is_null($user->banned_at))
    		{
    			echo "Your Account was Banned from using this service";
    		}else{
                $message = "hello this is test"; //char =200 (2)
                $phone_number = "9841984123,9849654318";
    			$balances = $user->UserBalance;
    			$total_balance= $user->UserBalance->sum('balance');
    			$total_coins= $user->UserBalance->sum('coins');
                //need to write function to calculate required coins
                $required_coins=10;
    			if($total_coins < $required_coins){
    				echo("You do not have sufficient balance to send the sms");
    			}else{
    				
                    //need a function to save this message history 
                    //
    				$this->send($message, $phone_number);
                    //success - update coin (totaloin - required coin)
    			}
    		}
    	}   	
    }
    public function send($message, $phone_number)
    {
    	echo "ready to send sms with";
        echo "<br>"."message:". $message;
        echo "<br>"."to :".$phone_number;
    }


    public function viewBalance($token)
    {
        $userToken = UserToken::where('token', $token)->first();
        $balances = $userToken->user->UserBalance;
        return $balances;
    }
}
