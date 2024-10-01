<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cars;
use App\Models\User;
use App\Models\ManageBooking;
use App\Models\BookingDeposit;



class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'car_id',
        'pickup_location',
        'dropoff_location',
        'start_datetime',
        'end_datetime',
        'status',
        'code_booking',
        'booking_group_id',
        'booking_duration',
        'total_price',
        'total_deposit',
        'total_payment',
        'total_additional_price',

    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function car()
    {
        return $this->belongsTo(cars::class, 'car_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ManageBooking()
    {
        return $this->hasMany(ManageBooking::class, 'booking_id ');
    }

    public function booking()
    {
        return $this->hasMany(booking::class, 'booking_id');
    }

    public function Bookings()
    {
        return $this->hasMany(BookingDeposit::class, 'booking_id');
    }
}
