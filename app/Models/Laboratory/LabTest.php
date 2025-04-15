<?php

namespace App\Models\Laboratory;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function items() {
        return $this->hasMany(LabOrderItem::class);
    }
}
