<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpenaiConfigResource\Pages;
use App\Filament\Resources\OpenaiConfigResource\RelationManagers;
use App\Models\OpenaiConfig;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OpenaiConfigResource extends Resource
{
    protected static ?string $model = OpenaiConfig::class;

    protected static ?string $navigationGroup = 'Insurance';
    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Model Name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('base_uri')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('endpoint')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('token')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('prompt')
                    ->maxLength(255)
                    ->default(null),
                    Forms\Components\Select::make('status')
                    
                    ->label('Assign Status')
                    ->options([
                        'ACTIVE' => 'ACTIVE',
                        'DISABLED' => 'DISABLED',
                        

                    ])
                    ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Model Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_uri')
                    ->searchable(),
                Tables\Columns\TextColumn::make('endpoint')
                    ->searchable(),
                Tables\Columns\TextColumn::make('token')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prompt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListOpenaiConfigs::route('/'),
            'create' => Pages\CreateOpenaiConfig::route('/create'),
            'view' => Pages\ViewOpenaiConfig::route('/{record}'),
            'edit' => Pages\EditOpenaiConfig::route('/{record}/edit'),
        ];
    }
}
