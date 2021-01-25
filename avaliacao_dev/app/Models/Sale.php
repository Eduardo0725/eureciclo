<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer',
        'description',
        'price_unit',
        'lot',
        'address',
        'vendor'
    ];
}
