<?php

namespace App\Models\Clinical;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class ClinicalHistory extends Model
{
    protected $fillable = [
        'patient_id',
        'family_history',
        'medical_history',
        'surgical_history',
        'gyne_ob_history',
        'vaccination_notes',
        'notes',
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function notes() {
        return $this->hasMany(ClinicalNote::class);
    }
}
