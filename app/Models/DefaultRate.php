<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultRate extends Model
{
    use HasFactory;
    protected $fillable = ['default_rate', 'created_by'];


    public function createdBy()
    {
    	return $this->belongsTo(User::class, 'created_by');
    }
}
