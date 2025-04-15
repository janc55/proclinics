<?php

namespace App\Filament\Resources\Imaging;

use App\Filament\Resources\Imaging\ImagingStudyResource\Pages;
use App\Filament\Resources\Imaging\ImagingStudyResource\RelationManagers;
use App\Models\Imaging\ImagingStudy;
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
use Illuminate\Support\Facades\Auth;

class ImagingStudyResource extends Resource
{
    protected static ?string $model = ImagingStudy::class;

    protected static ?string $navigationGroup = 'Centro de Imagenología';

    protected static ?string $navigationLabel = 'Estudios de Imágenes';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre del estudio')
                    ->required()
                    ->unique(ignoreRecord: true),
        
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->nullable(),
        
                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('price')->label('Precio')->money('BOB', true),
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
            ])->defaultSort('updated_at', 'desc');
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
            'index' => Pages\ListImagingStudies::route('/'),
            'create' => Pages\CreateImagingStudy::route('/create'),
            'edit' => Pages\EditImagingStudy::route('/{record}/edit'),
        ];
    }
}
