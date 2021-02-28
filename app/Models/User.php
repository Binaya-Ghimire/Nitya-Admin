<?php

namespace App\Models;

use App\Models\UserBalance;
use App\Models\BalanceHistory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'banned_at'=>'datetime',
    ];

    public function Userbalance()
    {
        return $this->hasMany(UserBalance::class);
    }

    public function history()
    {
        return $this->hasMany(BalanceHistory::class)->latest();
    }

    public function userToken()
    {
        return $this->hasMany(UserToken::class);
    }
     
}