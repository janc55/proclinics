<?php

namespace App\Models\Imaging;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ImagingOrderItem extends Model
{
    protected $fillable = ['imaging_order_id', 'imaging_study_id', 'report', 'images', 'processed_by_id'];

    protected $casts = [
        'images' => 'array',
    ];

    public function order() {
        return $this->belongsTo(ImagingOrder::class, 'imaging_order_id');
    }

    public function study() {
        return $this->belongsTo(ImagingStudy::class, 'imaging_study_id');
    }

    public function processedBy() {
        return $this->belongsTo(User::class, 'processed_by_id');
    }
}
