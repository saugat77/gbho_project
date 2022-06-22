<?php

namespace App\View\Components\Dashboard\Tiles;

use Carbon\Carbon;
use Illuminate\View\Component;

class EarningsChartTile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.tiles.earnings-chart-tile', [
            'from' => Carbon::now()->subDays(30)->format('Y-m-d'),
            'to' => Carbon::now()->format('Y-m-d'),
        ]);
    }
}
