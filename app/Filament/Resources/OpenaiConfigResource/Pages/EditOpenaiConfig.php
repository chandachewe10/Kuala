<?php

namespace App\Filament\Resources\OpenaiConfigResource\Pages;

use App\Filament\Resources\OpenaiConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOpenaiConfig extends EditRecord
{
    protected static string $resource = OpenaiConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
