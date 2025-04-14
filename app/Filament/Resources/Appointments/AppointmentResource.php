<?php

namespace App\Filament\Resources\Appointments;

use App\Filament\Resources\Appointments\AppointmentResource\Pages;
use App\Filament\Resources\Appointments\AppointmentResource\RelationManagers;
use App\Models\Appointments\Appointment;
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

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('patient_id')
                ->label('Paciente')
                ->relationship('patient', 'name')
                ->searchable()
                ->required(),

            Select::make('doctor_id')
                ->label('Médico')
                ->relationship('doctor', 'name')
                ->searchable()
                ->required(),

            Select::make('service_id')
                ->label('Servicio')
                ->relationship('service', 'name')
                ->required(),

            DateTimePicker::make('scheduled_at')
                ->label('Fecha y hora')
                ->required(),

            Select::make('status')
                ->options([
                    'pendiente' => 'Pendiente',
                    'confirmada' => 'Confirmada',
                    'cancelada' => 'Cancelada',
                    'reprogramada' => 'Reprogramada',
                    'atendida' => 'Atendida',
                ])
                ->default('pendiente')
                ->required(),

            Textarea::make('observations')
                ->label('Observaciones')
                ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name')->label('Paciente')->searchable(),
                TextColumn::make('doctor.name')->label('Médico')->searchable(),
                TextColumn::make('service.name')->label('Servicio')->sortable(),
                TextColumn::make('scheduled_at')
                    ->label('Fecha y hora')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
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
            ])->defaultSort('scheduled_at', 'desc');
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
