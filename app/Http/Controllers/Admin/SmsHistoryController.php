<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\SmsHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsHistoryController extends Controller
{
   public function __construct()
   {
   		$this->middleware('permission:sms-history', ['only'=>['smshistory', 'viewMessage']]);
   }

    public function smshistory(User $user)
    {
    	return view('admin.user.sms_history', compact('user'));
    }

    public function viewMessage(SmsHistory $smshistory)
    {
    	return view('admin.user.view_message', compact('smshistory'));	
    }
}
