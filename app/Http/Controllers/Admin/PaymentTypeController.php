<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function __construct(){
        $this->middleware('permission:payment-type-list|payment-type-create|payment-type-edit|payment-type-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payment-type-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-type-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $paymentTypes = PaymentType::all();
        return view('admin.paymentType.index',compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentType.create');
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
            'name'=>'required|string|max:100',
        ]);
        PaymentType::create([
            'name'=>$request->name,
        ]);
        toastr()->success('Payment type Added Successfully');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentType $paymentType)
    {
        return view('admin.paymentType.edit', compact('paymentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        $request->validate([
            'name'=>'required|string',
            'status'=>'required',
        ]);
        $paymentType->update([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);
        toastr()->success('Payment Type Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $paymentType)
    {
       try{
            $paymentType->delete();
        toastr()->success('Payment type Deleted Successfully');
       }catch(Exceptio $e){
        toastr()->error($e->getMessage());
       }
       return redirect()->back();
    }

    public function deactivate(PaymentType $paymentType)
    {
        $paymentType->status = 0;
        $paymentType->save();
        toastr()->error('Payment Type Marked as  Deactive');
        return redirect()->back();
    }
     public function activate(PaymentType $paymentType)
    {
        $paymentType->status = 1;
        $paymentType->save();
        toastr()->success('Payment Type Marked as  Active');
        return redirect()->back();
    }

}
