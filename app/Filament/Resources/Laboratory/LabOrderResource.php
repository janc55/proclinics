<?php

namespace App\Filament\Resources\Laboratory;

use App\Filament\Resources\Laboratory\LabOrderResource\Pages;
use App\Filament\Resources\Laboratory\LabOrderResource\RelationManagers;
use App\Models\Laboratory\LabOrder as LaboratoryLabOrder;
use App\Models\Laboratory\LabTest;
use App\Models\Laboratory\LabOrder;
use App\Models\Laboratory\LabOrderItem;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LabOrderResource extends Resource
{
    protected static ?string $model = LaboratoryLabOrder::class;

    protected static ?string $navigationGroup = 'Laboratorio Clínico';
    
    protected static ?string $navigationLabel = 'Órdenes de Laboratorio';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->relationship('patient', 'name') // puedes cambiar por document_number
                    ->label('Paciente')
                    ->required()
                    ->searchable(),
        
                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->label('Médico que solicita')
                    ->required()
                    ->searchable(),
        
                Hidden::make('requested_by_id')
                    ->default(Auth::id())
                    ->required()
                    ->disabled()
                    ->dehydrated(),
        
                DateTimePicker::make('requested_at')
                    ->label('Fecha de solicitud')
                    ->default(now())
                    ->required(),
        
                DateTimePicker::make('delivered_at')
                    ->label('Fecha de entrega')
                    ->nullable(),
        
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_proceso' => 'En proceso',
                        'completado' => 'Completado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->default('pendiente')
                    ->required(),
        
                FileUpload::make('result_file_path')
                    ->label('Resultado PDF')
                    ->directory('lab-orders')
                    ->downloadable()
                    ->openable()
                    ->nullable(),
                CheckboxList::make('test_ids')
                    ->label('Pruebas solicitadas')
                    ->options(LabTest::all()->pluck('name', 'id'))
                    ->columns(2)
                    ->required()
                    ->bulkToggleable(false),
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name')->label('Paciente')->searchable(),
                TextColumn::make('doctor.name')->label('Doctor')->searchable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('requested_at')->dateTime(),
                TextColumn::make('delivered_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('requested_at', 'desc');
    }

    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLabOrders::route('/'),
            'create' => Pages\CreateLabOrder::route('/create'),
            'edit' => Pages\EditLabOrder::route('/{record}/edit'),
        ];
    }
}
