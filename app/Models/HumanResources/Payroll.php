<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'period_start',
        'period_end',
        'base_salary',
        'bonuses',
        'deductions',
        'total_paid',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
