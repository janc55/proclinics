<?php

namespace App\Filament\Resources\Clinical\ClinicalNoteResource\Pages;

use App\Filament\Resources\Clinical\ClinicalNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClinicalNote extends CreateRecord
{
    protected static string $resource = ClinicalNoteResource::class;
}
