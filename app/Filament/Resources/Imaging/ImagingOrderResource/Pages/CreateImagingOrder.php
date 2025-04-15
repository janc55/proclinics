<?php

namespace App\Filament\Resources\Imaging\ImagingOrderResource\Pages;

use App\Filament\Resources\Imaging\ImagingOrderResource;
use App\Models\Imaging\ImagingOrder;
use App\Models\Imaging\ImagingOrderItem;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateImagingOrder extends CreateRecord
{
    protected static string $resource = ImagingOrderResource::class;
    protected function handleRecordCreation(array $data): Model
        {
            $studyIds = $data['study_ids'] ?? [];
            unset($data['study_ids']);

            $data['requested_by_id'] = Auth::id();

            $order = ImagingOrder::create($data);

            foreach ($studyIds as $studyId) {
                ImagingOrderItem::create([
                    'imaging_order_id' => $order->id,
                    'imaging_study_id' => $studyId,
                ]);
            }

            return $order;
        }
}
