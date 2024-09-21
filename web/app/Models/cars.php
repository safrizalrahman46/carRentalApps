<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarAvailability;
use App\Models\RentalRates;
use App\Models\Booking;

class cars extends Model
{
    use HasFactory;
    protected $table = 'cars';

    protected $fillable = [
        'car',
        'type',
        'capacity',
        'price_per_day',
        'price_per_km',
        'price_per_area',
        'availability_start_time',
        'availability_end_time',
        'is_available',

    ];

    public $timestamps = false;

    public function CarAvailability()
    {
        return $this->hasMany(CarAvailability::class, 'car_id');
    }

    public function RentalRates()
    {
        return $this->hasMany(RentalRates::class, 'car_id');
    }

    public function Booking()
    {
        return $this->hasMany(Booking::class, 'car_id');
    }
}
