<?php

namespace App\Models\HumanResources;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'position',
        'salary',
        'hire_date',
        'status',
        'contract_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
