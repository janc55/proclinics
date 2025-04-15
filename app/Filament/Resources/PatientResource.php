<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationGroup = 'Principal';
    
    protected static ?string $navigationLabel = 'Pacientes';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User ID')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('document_number')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birth_date'),
                Forms\Components\TextInput::make('sex'),
                Forms\Components\TextInput::make('blood_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('height_cm')
                    ->numeric(),
                Forms\Components\TextInput::make('weight_kg')
                    ->numeric(),
                Forms\Components\Textarea::make('allergies')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('medical_conditions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('emergency_contact')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sex'),
                Tables\Columns\TextColumn::make('blood_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('height_cm')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight_kg')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emergency_contact')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
