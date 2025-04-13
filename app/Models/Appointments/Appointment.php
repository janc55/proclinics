<?php

namespace App\Models\Appointments;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'service_id',
        'scheduled_at',
        'status',
        'observations',
    ];

    public function patient() {
        return $this->belongsTo(\App\Models\User::class, 'patient_id');
    }
    
    public function doctor() {
        return $this->belongsTo(\App\Models\User::class, 'doctor_id');
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
