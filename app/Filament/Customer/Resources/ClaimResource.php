<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\ClaimResource\Pages;
use App\Filament\Customer\Resources\ClaimResource\RelationManagers;
use App\Models\Claim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClaimResource extends Resource
{
    protected static ?string $model = Claim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->regex('/^(\+260|0)?\d{9}$/')
                    ->validationMessages([
                    'regex' => 'The phone number must be a valid Zambian phone number.',
                     ])
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('policy_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('incident_date')
                ->native(false)
                ->maxDate(now())
                    ->required(),
                Forms\Components\TextInput::make('incident_location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->cols(10)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('estimated_loss')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('police_report_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('witnesses')
                    ->columnSpanFull(),
               
                Forms\Components\Textarea::make('ai_feedback')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('attachment')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('policy_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('incident_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('incident_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estimated_loss')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('police_report_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('attachment')
                    ->searchable(),
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
            'index' => Pages\ListClaims::route('/'),
            'create' => Pages\CreateClaim::route('/create'),
            'view' => Pages\ViewClaim::route('/{record}'),
            'edit' => Pages\EditClaim::route('/{record}/edit'),
        ];
    }
}
