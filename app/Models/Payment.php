<?php

namespace App\Models;

use App\Models\User;
use App\Models\PaymentType;
use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
     protected $fillable = [
        'amount',
        'date',
        'payment_type',
        'status',
        'userid',
        'verified_by',
        'remark',
        'transaction_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'userid');
    }

    public function paymentstatus()
    {
        return $this->belongsTo(PaymentStatus::class,'status');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type');
    }


}