<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\InmateProfile;
use App\Models\Jailbook;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Inmates', InmateProfile::count())
                ->description('Registered inmates')
                ->icon('heroicon-o-user-group')
                ->color('primary'),

            Stat::make('Total Jailbooks', Jailbook::count())
                ->description('Recorded jail entries')
                ->icon('heroicon-o-book-open')
                ->color('success'),
        ];
    }
}