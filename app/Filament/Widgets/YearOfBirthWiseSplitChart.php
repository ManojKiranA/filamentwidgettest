<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\PieChartWidget;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class YearOfBirthWiseSplitChart extends PieChartWidget
{
    protected static ?string $pollingInterval = '15s';

    public $chartData;

    protected function getHeading(): string
    {
        return 'Blog posts';
    }

    //loads properly on initial load
    //issues in polling

    // public function mount()
    // {
    //     $this->chartData = User::query()
    //         ->toBase()
    //         ->selectRaw('YEAR(date_of_birth) as year_of_birth')
    //         ->addSelect(DB::raw('count(*) as total_no_of_users'))
    //         ->groupBy('year_of_birth')
    //         ->pluck('total_no_of_users', 'year_of_birth');
    // }

    //on the initial load the data will not be passed
    //polling works fine

    public function hydrate()
    {
        $this->chartData = User::query()
            ->toBase()
            ->selectRaw('YEAR(date_of_birth) as year_of_birth')
            ->addSelect(DB::raw('count(*) as total_no_of_users'))
            ->groupBy('year_of_birth')
            ->pluck('total_no_of_users', 'year_of_birth');
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $this?->chartData?->values(),
                ],
            ],
            'labels' => $this?->chartData?->keys(),
        ];
    }
}
