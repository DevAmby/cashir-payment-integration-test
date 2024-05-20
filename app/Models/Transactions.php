<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'tx_ref',
        'flw_ref',
        'device_fingerprint',
        'amount',
        'currency',
        'charged_amount',
        'app_fee',
        'merchant_fee',
        'ip',
        'narration',
        'status',
        'payment_type',
        'payment_method',
        'amount_settled',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
