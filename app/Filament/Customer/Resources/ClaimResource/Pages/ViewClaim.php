<?php

namespace App\Filament\Customer\Resources\ClaimResource\Pages;

use App\Filament\Customer\Resources\ClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClaim extends ViewRecord
{
    protected static string $resource = ClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
