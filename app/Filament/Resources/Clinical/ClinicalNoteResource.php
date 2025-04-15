<?php

namespace App\Filament\Resources\Clinical;

use App\Filament\Resources\Clinical\ClinicalNoteResource\Pages;
use App\Filament\Resources\Clinical\ClinicalNoteResource\RelationManagers;
use App\Models\Clinical\ClinicalNote;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClinicalNoteResource extends Resource
{
    protected static ?string $model = ClinicalNote::class;

    protected static ?string $navigationGroup = 'Clínica';
    
    protected static ?string $navigationLabel = 'Notas Clínicas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('clinical_history_id')
                    ->relationship('clinicalHistory', 'id')
                    ->label('Historial Clínico')
                    ->searchable()
                    ->required(),

                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->label('Médico')
                    ->searchable()
                    ->required(),

                Textarea::make('note')
                    ->label('Nota de Evolución')
                    ->rows(5)
                    ->required(),

                DateTimePicker::make('recorded_at')
                    ->label('Fecha de Registro')
                    ->default(now())
                    ->required(),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('doctor.name')->label('Médico')->searchable(),
                TextColumn::make('clinicalHistory.patient.user.name')->label('Paciente')->searchable(),
                TextColumn::make('recorded_at')->dateTime()->label('Fecha'),
                TextColumn::make('note')->limit(50)->wrap(),
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
            ])->defaultSort('recorded_at', 'desc');
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
            'index' => Pages\ListClinicalNotes::route('/'),
            'create' => Pages\CreateClinicalNote::route('/create'),
            'edit' => Pages\EditClinicalNote::route('/{record}/edit'),
        ];
    }
}
