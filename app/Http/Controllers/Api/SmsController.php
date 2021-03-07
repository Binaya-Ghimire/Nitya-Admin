<?php

namespace App\Http\Controllers\Api;

use App\Models\UserToken;
use App\Models\SmsHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\SendSms;

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
                $message = $request->message;
                $phone_number = $request->number;
                $required_coins = $this->calculateCoin($message);       
                $total_coins= $user->UserBalance->sum('coins');

                if($total_coins < $required_coins){
                    echo("You do not have sufficient balance to send the sms");
                }else{
                    $this->send($message, $phone_number);
                    SmsHistory::create([
                        'send_by'=>$user->id,
                        'send_to'=>$phone_number,
                        'message'=>$message,
                        'coins_used'=>$required_coins,
                    ]);
                    $remaining_balance = $this->deductCoin($user, $required_coins);
                    $msg = "msg sent to ".$phone_number."with coin cost ".$required_coins." and remaining balance is ". $remaining_balance;
                    return $msg;
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
        $send = new SendSms();
         $msg = $send->sendsms($phone_number, $message);
         return response($msg);

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

}
