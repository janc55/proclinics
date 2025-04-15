<?php

namespace App\Models\Consultations;

use App\Models\Appointments\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'appointment_id',
        'doctor_id',
        'patient_id',
        'diagnosis',
        'treatment',
        'observations',
        'next_appointment',
    ];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
