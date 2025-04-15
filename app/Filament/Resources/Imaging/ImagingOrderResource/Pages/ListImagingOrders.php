<?php

namespace App\Filament\Resources\Imaging\ImagingOrderResource\Pages;

use App\Filament\Resources\Imaging\ImagingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImagingOrders extends ListRecords
{
    protected static string $resource = ImagingOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
