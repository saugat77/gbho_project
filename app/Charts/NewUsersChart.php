<?php

declare(strict_types=1);

namespace App\Charts;

use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class NewUsersChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $from = $request->from ?? Carbon::now()->subDays(30);
        $to = $request->to ?? Carbon::now();
        $reportType = $request->report_type ?? 'date';

        $users = \App\User::select(\DB::raw($reportType . '(created_at) as label, count(id) as count'))
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('label')
            ->orderBy('label')
            ->pluck('count', 'label')
            ->all();


        $labels = collect(array_keys($users))->map(function ($label) use ($reportType) {
            switch ($reportType) {
                case 'year':
                case 'YEAR':
                    return Carbon::createFromFormat('Y', $label)->format('Y');
                case 'month':
                case 'MONTH':
                    return Carbon::createFromFormat('m', $label)->format('M');
                default:
                    return Carbon::createFromFormat('Y-m-d', $label)->format('M d');
            }
        })->toArray();

        // $customerDataset = [];
        // for ($month = 1; $month <= 12; $month++) {
        //     $customerDataset[$month] = $users[$month] ?? 0;
        // }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('New Customers', array_values($users));
    }
}
