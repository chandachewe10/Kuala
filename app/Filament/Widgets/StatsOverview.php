<?php

namespace App\Filament\Widgets;
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

                 
            Stat::make('Active Claims', Claim::query()
                ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                ->where('status', 'approved')
                ->count())
                ->description('Active Claims')
                ->descriptionIcon('heroicon-m-document-duplicate', IconPosition::Before)
                ->color('success'),

            Stat::make('Pending Claims', Claim::query()
                ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                ->where('status', 'pending')
                ->count(), )
                ->description('Pending Claims')
                ->descriptionIcon('heroicon-m-calendar', IconPosition::Before)
                ->color('primary')
                ,
            Stat::make('Denied Claims', Claim::query()
                ->when($startDate, fn(Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn(Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                ->where('status', 'denied')
                ->count(), )
                ->description('Denied Claims')
                ->descriptionIcon('heroicon-m-x-mark', IconPosition::Before)
                ->color('danger')
                
            
        ];
    }
}
