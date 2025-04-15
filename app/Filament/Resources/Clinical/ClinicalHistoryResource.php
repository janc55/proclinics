<?php

namespace App\Filament\Resources\Clinical;

use App\Filament\Resources\Clinical\ClinicalHistoryResource\Pages;
use App\Filament\Resources\Clinical\ClinicalHistoryResource\RelationManagers;
use App\Models\Clinical\ClinicalHistory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClinicalHistoryResource extends Resource
{
    protected static ?string $model = ClinicalHistory::class;

    protected static ?string $navigationGroup = 'Clínica';
    
    protected static ?string $navigationLabel = 'Historial Clínico';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->relationship('patient', 'document_number')
                    ->label('Paciente')
                    ->searchable()
                    ->required(),

                Textarea::make('family_history')
                    ->label('Antecedentes Familiares')
                    ->rows(4),

                Textarea::make('medical_history')
                    ->label('Antecedentes Médicos')
                    ->rows(4),

                Textarea::make('surgical_history')
                    ->label('Antecedentes Quirúrgicos')
                    ->rows(4),

                Textarea::make('gyne_ob_history')
                    ->label('Historia Ginecológica / Obstétrica')
                    ->rows(4),

                Textarea::make('vaccination_notes')
                    ->label('Vacunación')
                    ->rows(3),

                Textarea::make('notes')
                    ->label('Notas generales')
                    ->rows(3),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.user.name')->label('Paciente')->searchable(),
                TextColumn::make('updated_at')->label('Actualizado')->dateTime(),
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
            'index' => Pages\ListClinicalHistories::route('/'),
            'create' => Pages\CreateClinicalHistory::route('/create'),
            'edit' => Pages\EditClinicalHistory::route('/{record}/edit'),
        ];
    }
}
