<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingServices;


class AdditionalService extends Model
{
    use HasFactory;
    protected $table = 'additional_services';

    protected $fillable = [
        'name',
        'price',

    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function BookingServices()
    {
        return $this->belongsTo(BookingServices::class, 'car_id');
    }
}
