<?php

namespace App\Filament\Resources\Staff;

use App\Filament\Resources\Staff\PayrollResource\Pages;
use App\Filament\Resources\Staff\PayrollResource\RelationManagers;
use App\Models\HumanResources\Payroll as HumanResourcesPayroll;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PayrollResource extends Resource
{
    protected static ?string $model = HumanResourcesPayroll::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Select::make('employee_id')
                        ->label('Empleado')
                        ->relationship('employee.user', 'name') // 🔍 usa columna real
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name) // ✅ muestra nombre completo
                        ->searchable()
                        ->required(),
        
                    DatePicker::make('period_start')
                        ->label('Inicio del período')
                        ->required(),
        
                    DatePicker::make('period_end')
                        ->label('Fin del período')
                        ->required(),
        
                    TextInput::make('base_salary')
                        ->label('Salario base')
                        ->numeric()
                        ->prefix('Bs.')
                        ->required(),
        
                    TextInput::make('bonuses')
                        ->label('Bonos')
                        ->numeric()
                        ->default(0)
                        ->prefix('Bs.'),
        
                    TextInput::make('deductions')
                        ->label('Descuentos')
                        ->numeric()
                        ->default(0)
                        ->prefix('Bs.'),
        
                    TextInput::make('total_paid')
                        ->label('Total pagado')
                        ->numeric()
                        ->prefix('Bs.')
                        ->required()
                        ->hint('Suma automática si no se edita'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.user.full_name')
                    ->label('Empleado')
                    ->searchable(),

                TextColumn::make('period_start')
                    ->label('Desde')
                    ->date(),

                TextColumn::make('period_end')
                    ->label('Hasta')
                    ->date(),

                TextColumn::make('base_salary')
                    ->label('Base')
                    ->money('BOB'),

                TextColumn::make('bonuses')
                    ->label('Bonos')
                    ->money('BOB'),

                TextColumn::make('deductions')
                    ->label('Descuentos')
                    ->money('BOB'),

                TextColumn::make('total_paid')
                    ->label('Total pagado')
                    ->money('BOB')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'gray'),
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
            'index' => Pages\ListPayrolls::route('/'),
            'create' => Pages\CreatePayroll::route('/create'),
            'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }
}
