<?php

namespace App\Filament\Resources\Staff;

use App\Filament\Resources\Staff\EmployeeResource\Pages;
use App\Filament\Resources\Staff\EmployeeResource\RelationManagers;
use App\Models\HumanResources\Employee;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
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

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name') // 👈 usamos una columna real
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name) // 👈 mostramos el accessor
                    ->searchable()
                    ->required(),

                TextInput::make('position')
                    ->label('Cargo')
                    ->required(),

                TextInput::make('salary')
                    ->label('Salario base')
                    ->prefix('Bs.')
                    ->numeric()
                    ->required(),

                Select::make('contract_type')
                    ->label('Tipo de contrato')
                    ->options([
                        'indefinido' => 'Indefinido',
                        'plazo fijo' => 'Plazo fijo',
                        'consultoría' => 'Consultoría',
                    ])
                    ->default('indefinido')
                    ->required(),

                DatePicker::make('hire_date')
                    ->label('Fecha de contratación')
                    ->default(now())
                    ->required(),

                Toggle::make('status')
                    ->label('Activo')
                    ->default(true),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.full_name')->label('Nombre'),
                TextColumn::make('position')->label('Cargo')->sortable(),
                TextColumn::make('contract_type')->label('Contrato'),
                TextColumn::make('salary')->label('Salario')->money('BOB', true),
                TextColumn::make('hire_date')->label('Ingreso')->date(),
                IconColumn::make('status')->label('Activo')->boolean(),
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
            ])->defaultSort('position');
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
