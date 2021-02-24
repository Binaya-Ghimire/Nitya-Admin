<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function __construct(){
        $this->middleware('permission:payment-status-list|payment-status-create|payment-status-edit|payment-status-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payment-status-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-status-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-status-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $paymentStatuses = PaymentStatus::all();
        return view('admin.paymentStatus.index', compact('paymentStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status'=> 'required|string|max:100',
        ]);
        PaymentStatus::create([
            'status'=> $request->status,
        ]);
        toastr()->success('Payment Status created successfully');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentStatus $paymentStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentStatus $paymentStatus)
    {
        return view('admin.paymentStatus.edit', compact('paymentStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentStatus $paymentStatus)
    {
        $request->validate([
            'status'=> 'required|string|max:100',
        ]);
        $paymentStatus->update([
            'status'=>$request->status,
        ]);
        toastr()->success(' Pyament Status Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentStatus  $paymentStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentStatus $paymentStatus)
    {
        $paymentStatus->delete();
        toastr()->error('Payment Status Deleted Successfully');
        return redirect()->back();
    }
}
