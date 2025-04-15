<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'document_number',
        'birth_date',
        'sex',
        'blood_type',
        'height_cm',
        'weight_kg',
        'allergies',
        'medical_conditions',
        'emergency_contact',
        'address',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }
}
