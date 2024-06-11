<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_method',
        'proof_of_payment',
        'paid',
        'amount',
        'status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function approve()
    {
        return $this->belongsTo(Admin::class, 'approve_by');
    }

    public function reject()
    {
        return $this->belongsTo(Admin::class, 'reject_by');
    }
}
