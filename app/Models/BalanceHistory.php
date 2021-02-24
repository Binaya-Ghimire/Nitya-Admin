<?php

namespace App\Models;

use App\Models\User;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BalanceHistory extends Model
{
    use HasFactory;
    protected $fillable =['user_id', 'added_by', 'balance', 'payment_type', 'remarks', 'rate_per_sms', 'coins'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function addedBy()
    {
    	return $this->belongsTo(User::class, 'added_by');
    }

    public function paymentType()
    {
    	return $this->belongsTo(PaymentType::class, 'payment_type');
    }
}
