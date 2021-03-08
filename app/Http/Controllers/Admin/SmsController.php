<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\UserToken;
use App\Models\SmsHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\SendSms;

class SmsController extends Controller
{
    public function createSms()
    {
        $tokens = Auth::user()->userToken;
        return view('admin.sms.create', compact('tokens'));
    }

    public function sendSms(Request $request)
    {
    	$userToken = UserToken::where('token', $request->token)->first();
    	if ($userToken->status == 0) {
            toastr()->error("The key is not Active at the moment");
            return back()->withInput();
    	}else{
    		$user = $userToken->user;
    		if(!is_null($user->banned_at))
    		{
                toastr()->error("Your Account was Banned from using this service");
    			return redirect()->back();
    		}else{
                $message = $request->message;
                $phone_number = $request->number;
                $required_coins = $this->calculateCoin($message);       
    			$total_coins= $user->UserBalance->sum('coins');

    			if($total_coins < $required_coins){
                    toastr()->error("You do not have sufficient balance to send the sms");
    			}else{
    				// $this->send($message, $phone_number);

                    SmsHistory::create([
                        'send_by'=>$user->id,
                        'send_to'=>$phone_number,
                        'message'=>$message,
                        'coins_used'=>$required_coins,
                    ]);
                    $remaining_balance = $this->deductCoin($user, $required_coins);
                    toastr()->success("message sent ... With  total Coin Cost ".$required_coins." And remaining balance is ". $remaining_balance );
                    return redirect()->back();
    			}
    		}
    	}   	
    }

    private function calculateCoin($message)
    {
        $msg_length = Str::length($message);
        $required_coins = intdiv($msg_length, 160);
        $required_coins= $required_coins+1;
        return $required_coins;
    }

    public function send($message, $phone_number)
    {        
        $splitted_number =  substr($phone_number, 0, 3);
        if(in_array($splitted_number, ['984', '985', '986'])) {
            $send = new SendSms();
            $msg = $send->sendsms($phone_number, $message);
            echo $msg;
        }elseif(in_array($splitted_number, ['975', '974'])){
            echo "Ntc CDMA And NTC Sky";
        }elseif(in_array($splitted_number, ['980', '981', '982'])){
            echo "Cannot send to NCell at the moment";
        }elseif(in_array($splitted_number, ['961', '962', '988'])){
            echo "Cannot send to Smart Cell at the moment";
        }
    }

    public function deductCoin($user, $required_coins)
    {
        foreach ($user->Userbalance as $balance) {
             if($balance->coins > $required_coins){
                $balance->decrement('coins', $required_coins);
                break;
             }elseif($balance->coins == $required_coins){
                $balance->decrement('coins', $required_coins);
                $balance->delete();
             }else{
                $extra = $required_coins - $balance->coins;
                $balance->coins = 0;
                $balance->delete();
                $required_coins = $extra;
             }
         }
        $remaining_balance = $user->Userbalance->sum('coins');
        return $remaining_balance; 
    }


    public function checkNumber($phone_number)
    {
        $splitted_number =  substr($phone_number, 0, 3);
        if(in_array($splitted_number, ['984', '985', '986'])) {
            echo "Ntc Gsm Mobile";
        }elseif(in_array($splitted_number, ['975', '974'])){
            echo "Ntc CDMA And NTC Sky";
        }elseif(in_array($splitted_number, ['980', '981', '982'])){
            echo "Ncell GSM";
        }elseif(in_array($splitted_number, ['961', '962', '988'])){
            echo "Smart Cell GSM";
        }
        
    }
}
