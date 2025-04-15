<?php

namespace App\Filament\Resources\Imaging\ImagingStudyResource\Pages;

use App\Filament\Resources\Imaging\ImagingStudyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImagingStudies extends ListRecords
{
    protected static string $resource = ImagingStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
