<?php

namespace App\Filament\Resources\Clinical\ClinicalHistoryResource\Pages;

use App\Filament\Resources\Clinical\ClinicalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClinicalHistories extends ListRecords
{
    protected static string $resource = ClinicalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
