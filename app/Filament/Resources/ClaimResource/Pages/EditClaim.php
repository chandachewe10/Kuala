<?php

namespace App\Filament\Resources\ClaimResource\Pages;

use App\Filament\Resources\ClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Notifications\ClaimStatusNotification;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EditClaim extends EditRecord
{
    protected static string $resource = ClaimResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
       // dd($data);
        
        $status = $data['status'];

        switch ($status) {
            case 'approved':
                $message = 'Hello ' . $record->full_name . ', your claim has been approved successfully.';
                break;

            case 'pending':
                $message = 'Hello ' . $record->full_name . ', your claim is being reviewed and will be approved soon.';
                break;

            case 'denied':
                $message = 'Hello ' . $record->full_name . ', your claim has been rejected.';
                break;

            case 'defaulted':
                $message = 'Hello ' . $record->full_name . ', unfortunately, your loan is in default status. Please contact us as soon as possible to discuss the situation.';
                break;

            default:
                $message = 'Hello ' . $record->full_name . ', your claim is being reviewed and will be approved soon.';
                break;
        }

       
       

       
        $record->update($data);
        $user = User::where('email',$data['email'])->first();
        if($user){
            $user->notify(new ClaimStatusNotification($message));
        }
        
        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
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
            ->body('The Claim has been updated successfully.');
    }
}
