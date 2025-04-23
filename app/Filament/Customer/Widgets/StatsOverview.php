<?php

namespace App\Filament\Customer\Widgets;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Carbon\CarbonImmutable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Claim;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        
        return [

                 
            Stat::make('Your Active Claims', Claim::query()
                ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                ->where('status', 'approved')
                ->where('userId',auth()->user()->id)
                ->count())
                ->description('Active Claims')
                ->descriptionIcon('heroicon-m-document-duplicate', IconPosition::Before)
                ->color('success'),

            Stat::make('Your Pending Claims', Claim::query()
                ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                ->where('status', 'pending')
                ->where('userId',auth()->user()->id)
                ->count(), )
                ->description('Pending Claims')
                ->descriptionIcon('heroicon-m-calendar', IconPosition::Before)
                ->color('primary')
                ,
               
            Stat::make('Your Denied Claims', Claim::query()
                ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                ->where('status', 'denied')
                ->where('userId',auth()->user()->id)
                ->count()
                
                , )
                ->description('Denied Claims')
                ->descriptionIcon('heroicon-m-x-mark', IconPosition::Before)
                ->color('danger')
                
            
        ];
    }
}
