<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:token-list', ['only' => ['index','show']]);
        $this->middleware('permission:token-create', ['only' => ['create','store']]);
        $this->middleware('permission:token-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:token-delete', ['only' => ['destroy']]);
        
    }

    public function index()
    {
        $tokens = UserToken::all();
        return view('admin.token.index', compact('tokens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.token.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $token = UserToken::create([
            'user_id'=>$request->user_id,
            'token'=>Str::random(60),
            'created_by'=>Auth::id(),
            'status'=>$request->status,
            'token_for'=>$request->token_for,
        ]);
        toastr()->success("User Token Generated Successfully");
        return redirect()->route('view-tokens');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserToken  $userToken
     * @return \Illuminate\Http\Response
     */
    public function show(UserToken $userToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserToken  $userToken
     * @return \Illuminate\Http\Response
     */
    public function edit(UserToken $userToken)
    {
        $users = User::all();
        return view('admin.token.edit', compact('users', 'userToken'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserToken  $userToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserToken $userToken)
    {
        $userToken->update([
            'user_id'=>$request->user_id,
           'status'=>$request->status,
           'token_for'=>$request->token_for,
        ]);
        toastr()->success('User Token Updated Successfully');
        return redirect()->route('view-tokens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserToken  $userToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserToken $userToken)
    {
       $userToken->update([
            'status'=>3,
       ]);

       toastr()->error('Token Marked As Deleted !!');
       return redirect()->back();
    }
}
