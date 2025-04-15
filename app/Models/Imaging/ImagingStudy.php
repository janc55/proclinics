<?php

namespace App\Models\Imaging;

use Illuminate\Database\Eloquent\Model;

class ImagingStudy extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function items()
    {
        return $this->hasMany(ImagingOrderItem::class);
    }
}
