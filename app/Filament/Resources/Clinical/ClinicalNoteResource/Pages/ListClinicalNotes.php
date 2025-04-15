<?php

namespace App\Filament\Resources\Clinical\ClinicalNoteResource\Pages;

use App\Filament\Resources\Clinical\ClinicalNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClinicalNotes extends ListRecords
{
    protected static string $resource = ClinicalNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
