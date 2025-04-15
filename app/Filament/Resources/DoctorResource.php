<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationGroup = 'Principal';
    
    protected static ?string $navigationLabel = 'Doctores';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Usuario')
                    ->required()
                    ->searchable(),
        
                TextInput::make('specialty')
                    ->label('Especialidad')
                    ->required(),
        
                TextInput::make('license_number')
                    ->label('N° de Matrícula')
                    ->nullable(),
        
                TextInput::make('consultation_price')
                    ->label('Costo Consulta')
                    ->numeric()
                    ->prefix('Bs.')
                    ->nullable(),
        
                Textarea::make('biography')
                    ->label('Biografía')
                    ->rows(4)
                    ->nullable(),
        
                Toggle::make('status')
                    ->label('Activo')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Usuario')->searchable(),
                TextColumn::make('specialty')->label('Especialidad'),
                TextColumn::make('license_number')->label('Matrícula'),
                TextColumn::make('consultation_price')->label('Consulta')->money('BOB', true),
                IconColumn::make('status')->boolean()->label('Activo'),
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
            ])->defaultSort('specialty');
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
