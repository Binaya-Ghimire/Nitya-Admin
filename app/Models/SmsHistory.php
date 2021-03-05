<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SmsHistory extends Model
{
    use HasFactory;

    protected $fillable = ['send_by', 'send_to', 'message' ,'coins_used', 'status'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'send_by');
    }
}
