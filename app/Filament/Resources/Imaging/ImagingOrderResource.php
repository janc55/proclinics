<?php

namespace App\Filament\Resources\Imaging;

use App\Filament\Resources\Imaging\ImagingOrderResource\Pages;
use App\Filament\Resources\Imaging\ImagingOrderResource\RelationManagers;
use App\Models\Imaging\ImagingOrder;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ImagingOrderResource extends Resource
{
    protected static ?string $model = ImagingOrder::class;

    protected static ?string $navigationGroup = 'Centro de Imagenología';
    
    protected static ?string $navigationLabel = 'Órdenes de Imágenes';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->label('Paciente')
                    ->required()
                    ->searchable(),

                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->label('Médico solicitante')
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
                    ->label('Informe PDF')
                    ->directory('imaging-orders')
                    ->downloadable()
                    ->openable()
                    ->nullable(),

                CheckboxList::make('study_ids')
                    ->label('Estudios solicitados')
                    ->options(\App\Models\Imaging\ImagingStudy::all()->pluck('name', 'id'))
                    ->columns(2)
                    ->required(),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('requested_by_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('requested_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivered_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('result_file_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ]);
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
            'index' => Pages\ListImagingOrders::route('/'),
            'create' => Pages\CreateImagingOrder::route('/create'),
            'edit' => Pages\EditImagingOrder::route('/{record}/edit'),
        ];
    }
}
