<?php

namespace App\Filament\Resources\Imaging\ImagingOrderResource\Pages;

use App\Filament\Resources\Imaging\ImagingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImagingOrder extends EditRecord
{
    protected static string $resource = ImagingOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
