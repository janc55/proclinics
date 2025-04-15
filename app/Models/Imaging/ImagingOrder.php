<?php

namespace App\Models\Imaging;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ImagingOrder extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id', 'requested_by_id',
        'requested_at', 'delivered_at', 'status', 'result_file_path'
    ];

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function requestedBy() {
        return $this->belongsTo(User::class, 'requested_by_id');
    }

    public function items() {
        return $this->hasMany(ImagingOrderItem::class);
    }
}
