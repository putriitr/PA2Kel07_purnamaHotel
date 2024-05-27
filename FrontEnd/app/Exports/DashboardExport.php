<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardExport implements FromCollection
{
    protected $period;

    public function __construct($period)
    {
        $this->period = $period;
    }

    public function collection()
    {
        // Define date format and group format based on the selected period
        switch ($this->period) {
            case 'week':
                $dateFormat = 'Y-W';
                $groupFormat = '%Y-%u';
                break;
            case 'month':
                $dateFormat = 'Y-m';
                $groupFormat = '%Y-%m';
                break;
            case 'year':
                $dateFormat = 'Y';
                $groupFormat = '%Y';
                break;
            case 'day':
            default:
                $dateFormat = 'Y-m-d';
                $groupFormat = '%Y-%m-%d';
                break;
        }

        // Query payment data based on the selected period
        $payments = Payment::where('status', 'approved')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare collection for export
        $collection = new Collection();
        $collection->push(['Date', 'Total']);

        foreach ($payments as $payment) {
            $collection->push([$payment->date, $payment->total]);
        }

        return $collection;
    }
}
