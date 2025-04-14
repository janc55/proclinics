<?php

namespace App\Filament\Resources\Appointments\AppointmentResource\Pages;

use App\Filament\Resources\Appointments\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;
}
