<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\DefaultRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:default-rate-list|default-rate-create|default-rate-edit', ['only' => ['index','show']]);
         $this->middleware('permission:default-rate-create', ['only' => ['create','store']]);
         $this->middleware('permission:default-rate-edit', ['only' => ['edit','update']]);
    }

    public function index()
    {
        $rates = DefaultRate::all();
        return view('admin.defaultrate.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.defaultrate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DefaultRate::create([
            'default_rate'=>$request->default_rate,
            'created_by'=>Auth::id(),
        ]);
        toastr()->success('Default Rate Added Successfully');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rate = DefaultRate::findOrFail($id);
        return view('admin.defaultrate.edit', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rate = DefaultRate::findOrFail($id);
        $rate->update([
            'default_rate'=>$request->default_rate,  
        ]);
        toastr()->success('Default Rate Updated Successfully');
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
}
