<?php

namespace App\Filament\Resources\Laboratory\LabOrderResource\Pages;

use App\Filament\Resources\Laboratory\LabOrderResource;
use App\Models\Laboratory\LabOrder;
use App\Models\Laboratory\LabOrderItem;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateLabOrder extends CreateRecord
{
    protected static string $resource = LabOrderResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $order = LabOrder::create($data);
        
        // Si usas CheckboxList
        if (isset($data['test_ids'])) {
            foreach ($data['test_ids'] as $testId) {
                LabOrderItem::create([
                    'lab_order_id' => $order->id,
                    'lab_test_id' => $testId,
                    'status' => 'pending'
                ]);
            }
        }
        
        return $order;
    }
}
