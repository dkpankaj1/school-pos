<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'company',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'country',
        'logo',
        'fev_icon',
        'currency_code',
        'currency_symbol',
    ];
}
