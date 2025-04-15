<?php

namespace App\Filament\Resources\Staff\EmployeeResource\Pages;

use App\Filament\Resources\Staff\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
