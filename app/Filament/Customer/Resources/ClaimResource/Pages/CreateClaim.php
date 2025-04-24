<?php

namespace App\Filament\Customer\Resources\ClaimResource\Pages;

use App\Filament\Customer\Resources\ClaimResource;
use Filament\Notifications\Notification;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Notifications\ClaimStatusNotification;
Use App\Models\User;
use Auth;

class CreateClaim extends CreateRecord
{
    protected static string $resource = ClaimResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['userId'] = Auth::user()->id;
        $data['email'] = Auth::user()->email;
       
       
        $status = "PENDING";
        $message = 'Hello ' . auth()->user()->name . ', your claim has been submitted successfully and is now '.$status.' review. You will be updated via email once it is reviewed.';
        $user = User::where('email',"=",auth()->user()->email)->first();
        $user->notify(new ClaimStatusNotification($message));

        return $data;

       
        
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Claim updated')
            ->body('The Claim has been submitted successfully and is now pending review.');
    }
}
