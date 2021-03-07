<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\UserBalance;
use App\Models\DefaultRate;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;
use App\Models\BalanceHistory;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payment-list', ['only' => ['index','show']]);
        $this->middleware('permission:payment-edit', ['only' => ['update']]);
        $this->middleware('permission:payment-report', ['only' => ['paymentReport']]);
        $this->middleware('permission:balance-report', ['only' => ['balanceReport']]);
        $this->middleware('permission:user-balance-report', ['only'=>['getBalanceReportByUser']]);

        
    }

    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $statuses = PaymentStatus::all();
        $rate = DefaultRate::first();
        return view('admin.payments.show', compact('payment', 'statuses', 'rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update([
            'status'=>$request->status,
            'remark'=>$request->remarks,
            'verified_by'=>Auth::id(),
        ]);
        if(is_null($request->rate)){
            $rates= DefaultRate::first();
            $rate = $rates->default_rate;
        }
        else{
            $rate = $request->rate;
        }
        if ($payment->paymentstatus->status =='Approved') {
           $user_balance =UserBalance::create([
            'user_id'=> $payment->userid,
            'balance'=>$payment->amount,
            'rate_per_sms'=>$rate,
            'coins'=>round($payment->amount/$rate),
           ]);
           BalanceHistory::create([
                'user_id'=> $payment->userid,
                'payment_type'=> $payment->payment_type,
                'added_by'=> $payment->userid,
                'balance'=> $payment->amount,
                'coins'=>$payment->amount/$rate,
                'remarks'=>$request->remarks,
           ]);
           toastr()->success('Balance Added successfully');     
        }
        else{
            toastr()->error('Balance Not Updated');
        }
        toastr()->success('Payment Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentReport()
    {
        $users = User::all();
        $user_history = BalanceHistory::all();
        $user_balance = UserBalance::all();
        return view('admin.payments.report',compact('users', 'user_history', 'user_balance'));
    }

    public function userPaymentReport(Request $request)
    {
        $users = User::all();
        if (is_null($request->start_date) && is_null($request->end_date)) {
            $user_history = BalanceHistory::where('user_id',$request->user_id)->get();
            $user_balance = UserBalance::where('user_id',$request->user_id)->get();
        }elseif (is_null($request->end_date)) {
            $user_history = BalanceHistory::where('user_id',$request->user_id)->whereDate('created_at', '>=', $request->start_date)->get();
            $user_balance = UserBalance::where('user_id',$request->user_id)->whereDate('created_at', '>=', $request->start_date)->get();
        }

        else{
            $user_id = $request->user_id;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $user_history = BalanceHistory::where('user_id', $user_id)->whereBetween('created_at',[$start_date, $end_date])->get();
            $user_balance = UserBalance::where('user_id',$user_id)->whereBetween('created_at', [$start_date, $end_date])->get();
        }
       
        return view('admin.payments.report', compact('user_history', 'user_balance', 'users'));

    }

    public function balanceReport()
    {
        $users =  User::all();
        $balances = UserBalance::all();
        return view('admin.payments.balance_report', compact('users', 'balances'));
    }
    public function userBalanceReport(Request $request)
    {
        $users = User::all();
        if(is_null($request->start_date) && is_null($request->end_date))
        {
            $balances = UserBalance::where('user_id', $request->user_id)->get();
        }elseif(is_null($request->end_date))
        {
             $balances = UserBalance::where('user_id', $request->user_id)->whereDate('created_at', '>=', $request->start_date)->get();
        }else{
            $balances = UserBalance::where('user_id', $request->user_id)->whereBetween('created_at', [$request->start_date, $request->end_date])->get();
        }
        
        return view('admin.payments.balance_report', compact('users', 'balances'));
    }

    public function getBalanceReportByUser(User $user)
    {
        
        return view('admin.user.user_report', compact('user'));
    }
}
