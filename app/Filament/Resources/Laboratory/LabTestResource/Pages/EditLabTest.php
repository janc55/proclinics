<?php

namespace App\Filament\Resources\Laboratory\LabTestResource\Pages;

use App\Filament\Resources\Laboratory\LabTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabTest extends EditRecord
{
    protected static string $resource = LabTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
