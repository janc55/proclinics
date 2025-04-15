<?php

namespace App\Filament\Resources\Imaging\ImagingOrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('imaging_study_id')
                ->label('Estudio de imagen')
                ->relationship('study', 'name')
                ->disabled()
                ->required(),

                Forms\Components\Textarea::make('report')
                    ->label('Informe médico')
                    ->rows(5)
                    ->nullable(),

                Forms\Components\FileUpload::make('images')
                    ->label('Imágenes del estudio')
                    ->directory('imaging-results')
                    ->image()
                    ->multiple()
                    ->preserveFilenames()
                    ->reorderable()
                    ->openable()
                    ->downloadable()
                    ->nullable(),

                Forms\Components\Select::make('processed_by_id')
                    ->label('Procesado por')
                    ->relationship('processedBy', 'name')
                    ->searchable()
                    ->default(Auth::id())
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('study.name')
            ->columns([
                Tables\Columns\TextColumn::make('study.name')->label('Estudio'),
                Tables\Columns\TextColumn::make('processedBy.name')->label('Procesado por')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Actualizado')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('updated_at', 'desc');
    }
}
