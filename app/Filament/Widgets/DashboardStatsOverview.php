<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardStatsOverview extends BaseWidget
{
    public $userCount;

    public function mount()
    {
        $this->userCount = User::query()->count();
    }


    protected function getCards(): array
    {
        // User::query()->count();

        return [
            Card::make('Unique views', $this->userCount),
            Card::make('Bounce rate', '21%'),
            Card::make('Average time on page', '3:12'),

            Card::make('Unique views', '192.1k'),
            Card::make('Bounce rate', '21%'),
            Card::make('Average time on page', '3:12'),
        ];
    }
}
