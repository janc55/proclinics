<?php

namespace App\Models\Clinical;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ClinicalNote extends Model
{
    protected $fillable = [
        'clinical_history_id',
        'doctor_id',
        'note',
        'recorded_at',
    ];

    public function clinicalHistory() {
        return $this->belongsTo(ClinicalHistory::class);
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
