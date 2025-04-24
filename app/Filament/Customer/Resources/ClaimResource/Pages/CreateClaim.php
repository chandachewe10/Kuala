<?php

namespace App\Filament\Customer\Resources\ClaimResource\Pages;

use App\Filament\Customer\Resources\ClaimResource;
use App\Notifications\ClaimStatusNotication;
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

        $user = auth()->user();
        $message = 'Hello ' . $user->name . ', your claim has been submitted successfully and is now pending review. You will be updated via email once it is reviewed.';
        $user->notify(new ClaimStatusNotification($message));
        
    }


    protected function getRedirectUrl(): string
    {
       
        return $this->getResource()::getUrl('index');
    }
}
