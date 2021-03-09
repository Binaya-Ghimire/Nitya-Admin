<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DefaultRate;
use App\Models\UserBalance;
use App\Models\BalanceHistory;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-ban', ['only' => ['banUser']]);
         $this->middleware('permission:user-unban', ['only' => ['unbanUser']]);
         $this->middleware('permission:user-login', ['only' => ['loginWithoutPass']]);
         $this->middleware('permission:user-add-balance', ['only' => ['addBlanceForm', 'addBalance']]);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
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
            'name'=>'required|max:50|string',
            'email'=>'required|unique:users',
            'password'=>'required|min:8|confirmed',
            'mobile'=>'required|digits:10|'
        ]);

        try{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'password'=>Hash::make($request->password),
            ]);
            $user->AssignRole($request->role);    
            toastr()->success('User Created Successfully');
        }catch(Exception $e){
            toastr()->error($e->getMessage());
        }  
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $rate = DefaultRate::take(1)->get();
        return view('admin.user.show', compact('user', 'rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required|max:50|string',
            'email'=>'required',
        ]);
        try{
            $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            ]);
            $user->syncRoles($request->role);
            toastr()->success('User Updated Successfully');
        }catch(Exception $e){
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    public function updatePassword(Request $request, User $user)
    {
        $data= $request->validate([
            'password'=> 'required|string|min:8|confirmed',
        ]);
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        toastr()->success('Password Updated Successfully');
        return back();
    }


    public function banUser(User $user)
    {
        $user->banned_at= now();
        $user->save();
        toastr()->info('User Banned Successfully');
        return redirect()->back();
    }

    public function unbanUser(User $user)
    {
        $user->banned_at = null;
        $user->save();
        toastr()->info('User Banned Successfully');
        return redirect()->back();
    }

    public function loginWithoutPass(User $user)
    {
        Auth::loginUsingId($user->id);
        toastr()->success("Logged in to ". $user->name. " Dashboard");
        return redirect()->route('admin-dashboard');
    }

    public function addBlanceForm(User $user)
    {
        $default_rate = DefaultRate::first();
        return view('admin.user.addbalance', compact('user', 'default_rate'));
    }

    public function addBalance(Request $request, User $user)
    {
        if(is_null($request->rate)){
            $rates= DefaultRate::first();
            $rate = $rates->default_rate;
        }
        else{
            $rate = $request->rate;
        }
        $user_balance = UserBalance::create([
            'user_id'=>$user->id,
            'balance'=>$request->amount,
            'rate_per_sms'=>$rate,
            'coins'=>round($request->amount/$rate),
        ]);
        BalanceHistory::create([
            'user_id'=>$user->id,
            'added_by'=>Auth::id(),
            'balance'=>$request->amount,
            'rate_per_sms'=>$rate,
            'coins'=>round($request->amount/$rate),
            'remarks'=>$request->remarks,
        ]);

        toastr()->success('Balance Added successfully');
        toastr()->success('Blance History Created');
        return redirect()->route('show-user',[$user]);
    }

}
