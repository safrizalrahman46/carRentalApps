<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class BookingDeposit extends Model
{
    use HasFactory;
    protected $table = 'booking_deposits';

    protected $fillable = [
        'booking_id',
        'deposit_amount',
        'status',
    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function booking()
    {
        return $this->belongsTo(booking::class, 'booking_id');
    }



}
