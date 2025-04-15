<?php

namespace App\Filament\Resources\Laboratory;

use App\Filament\Resources\Laboratory\LabTestResource\Pages;
use App\Filament\Resources\Laboratory\LabTestResource\RelationManagers;
use App\Models\Laboratory\LabTest;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabTestResource extends Resource
{
    protected static ?string $model = LabTest::class;

    protected static ?string $navigationGroup = 'Laboratorio Clínico';
    
    protected static ?string $navigationLabel = 'Exámenes de Laboratorio';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre del examen')
                    ->required()
                    ->unique(),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3),

                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->default(0),

                TextInput::make('unit')
                    ->label('Unidad de medida')
                    ->placeholder('mg/dL, mmol/L, etc.')
                    ->nullable(),

                TextInput::make('reference_min')
                    ->label('Valor mínimo')
                    ->numeric()
                    ->nullable(),

                TextInput::make('reference_max')
                    ->label('Valor máximo')
                    ->numeric()
                    ->nullable(),

                Textarea::make('reference_text')
                    ->label('Texto de referencia')
                    ->placeholder('Ej: Hombres: 35-50, Mujeres: 40-60')
                    ->rows(2),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('unit')->label('Unidad'),
                TextColumn::make('reference_min')->label('Mínimo'),
                TextColumn::make('reference_max')->label('Máximo'),
                TextColumn::make('price')->money('BOB', true)->sortable(),
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
            'index' => Pages\ListLabTests::route('/'),
            'create' => Pages\CreateLabTest::route('/create'),
            'edit' => Pages\EditLabTest::route('/{record}/edit'),
        ];
    }
}
