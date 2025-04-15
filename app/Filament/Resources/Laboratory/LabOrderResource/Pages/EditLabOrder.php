<?php

namespace App\Filament\Resources\Laboratory\LabOrderResource\Pages;

use App\Filament\Resources\Laboratory\LabOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabOrder extends EditRecord
{
    protected static string $resource = LabOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
