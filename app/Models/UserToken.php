<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserToken extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'token', 'created_by', 'status', 'token_for'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
    	return $this->belongsTo(User::class, 'created_by');
    }
}
