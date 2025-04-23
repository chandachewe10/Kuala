<?php

namespace App\Filament\Customer\Resources\ClaimResource\Pages;

use App\Filament\Customer\Resources\ClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Auth;

class CreateClaim extends CreateRecord
{
    protected static string $resource = ClaimResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['userId'] = Auth::user()->id;
       
        return $data;
    }


    protected function getRedirectUrl(): string
    {
       
        return $this->getResource()::getUrl('index');
    }
}
