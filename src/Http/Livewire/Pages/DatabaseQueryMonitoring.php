<?php

namespace Ansuman\LaraMon\Http\Livewire\Pages;

use Ansuman\LaraMon\Models\LaraMonDbQuery;
use Livewire\Component;

class DatabaseQueryMonitoring extends Component
{
    public $slowQueryData = [];

    public function mount()
    {
        $this->slowQueryData = $this->getSlowQueryData();
    }

    public function render()
    {
        $slowQueriesCount = LaraMonDbQuery::where('execution_time', '>', config('laramon.slow_query_threshold', 300))->count();

        return view('laramon::livewire.pages.database-query-monitoring', [
            'slowQueryData' => $this->slowQueryData,
            'stats' => [
                [
                    'title' => 'Total Slow Queries',
                    'value' => number_format($slowQueriesCount),
                    'icon' => 'exclamation-triangle',
                    'bgColor' => 'bg-accent-content',
                    'subtitle' => 'Queries that took more than ' . config('laramon.slow_query_threshold', 300) . ' ms',
                ],
            ],
        ])->layout('laramon::layouts.app');
    }

    /**
     * Get slow query data
     */
    public function getSlowQueryData()
    {
        $queries = LaraMonDbQuery::selectRaw("
            DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as hour,
            COUNT(*) as slow_query_count
        ")
            ->where('execution_time', '>', config('laramon.slow_query_threshold', 300))
            ->groupBy('hour')
            ->orderBy('hour', 'asc')
            ->get();

        $labels = $queries->pluck('hour')->toArray();
        $values = $queries->pluck('slow_query_count')->toArray();

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }


}
