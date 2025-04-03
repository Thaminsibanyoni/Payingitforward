<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DonationWithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donation_id',
        'payment_method',
        'amount',
        'status', // pending, approved, rejected
        'admin_comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
