<?php

namespace App\Models\Laboratory;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LabOrderItem extends Model
{
    protected $fillable = ['lab_order_id', 'lab_test_id', 'result', 'observations', 'processed_by_id'];


    public function order() {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    public function test() {
        return $this->belongsTo(LabTest::class, 'lab_test_id');
    }
    public function processedBy() {
        return $this->belongsTo(User::class, 'processed_by_id');
    }
}
