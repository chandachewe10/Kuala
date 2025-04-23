<?php

namespace App\Filament\Resources\OpenaiConfigResource\Pages;

use App\Filament\Resources\OpenaiConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOpenaiConfigs extends ListRecords
{
    protected static string $resource = OpenaiConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
