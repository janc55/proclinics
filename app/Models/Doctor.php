<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'specialty',
        'license_number',
        'biography',
        'phone',
        'consultation_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
