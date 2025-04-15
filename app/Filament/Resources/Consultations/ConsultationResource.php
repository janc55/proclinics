<?php

namespace App\Filament\Resources\Consultations;

use App\Filament\Resources\Consultations\ConsultationResource\Pages;
use App\Filament\Resources\Consultations\ConsultationResource\RelationManagers;
use App\Models\Consultations\Consultation;
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

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;

    protected static ?string $navigationGroup = 'Clínica';
    
    protected static ?string $navigationLabel = 'Consultas Médicas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('appointment_id')
                    ->relationship('appointment', 'id')
                    ->label('Cita Asociada')
                    ->required(),

                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->label('Médico')
                    ->required(),

                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->label('Paciente')
                    ->required(),

                Textarea::make('diagnosis')
                    ->label('Diagnóstico')
                    ->rows(3),

                Textarea::make('treatment')
                    ->label('Tratamiento')
                    ->rows(3),

                Textarea::make('observations')
                    ->label('Observaciones')
                    ->rows(3),

                DateTimePicker::make('next_appointment')
                    ->label('Próxima consulta'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('appointment.id')->label('Cita'),
                TextColumn::make('doctor.name')->label('Médico')->searchable(),
                TextColumn::make('patient.name')->label('Paciente')->searchable(),
                TextColumn::make('diagnosis')->limit(30),
                TextColumn::make('next_appointment')
                    ->dateTime()
                    ->label('Seguimiento'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Fecha')
                    ->sortable(),
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
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }
}
