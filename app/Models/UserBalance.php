<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance', 'rate_per_sms', 'coins'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
