<?php

namespace Ansuman\LaraMon\Http\Livewire\Pages;

use DB;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render(): mixed
    {
        $totalRequests = DB::table('laramon_requests')->count();
        $uniqueUsers = DB::table('laramon_requests')->distinct('user_id')->count('user_id');
        $avgResponseTime = round(DB::table('laramon_requests')->avg('execution_time'), 2);
        $slowRequests = DB::table('laramon_requests')->where('is_slow', true)->count();
        $totalDataSent = round(DB::table('laramon_requests')->sum('response_size') / 1024 / 1024, 2);
        $status500s = DB::table('laramon_requests')->where('status_code', 500)->count();

        $yesterday = Carbon::now()->subDay();

        $yesterdayTotalRequests = DB::table('laramon_requests')
            ->where('created_at', '>=', $yesterday)
            ->count();

        $yesterdayAvgResponseTime = DB::table('laramon_requests')
            ->where('created_at', '>=', $yesterday)
            ->avg('execution_time');

        $yesterdayStatus500s = DB::table('laramon_requests')
            ->where('created_at', '>=', $yesterday)
            ->where('status_code', 500)
            ->count();

        return view('laramon::livewire.pages.dashboard', [
            'stats' => [
                [
                    'title' => 'Total Requests',
                    'value' => number_format($totalRequests),
                    'icon' => 'server',
                    'bgColor' => 'bg-accent-content',
                    'trend' => $this->calculateTrend($totalRequests, $yesterdayTotalRequests),
                    'subtitle' => 'Requests in last 24h',
                ],
                [
                    'title' => 'Unique Users',
                    'value' => number_format($uniqueUsers),
                    'icon' => 'user',
                    'bgColor' => 'bg-accent-content',
                    'subtitle' => 'Users who made a request',
                ],
                [
                    'title' => 'Avg Response Time',
                    'value' => "{$avgResponseTime}ms",
                    'icon' => 'clock',
                    'bgColor' => 'bg-accent-content',
                    'trend' => $this->calculateTrend($avgResponseTime, $yesterdayAvgResponseTime),
                    'subtitle' => 'Performance over time',
                ],
                [
                    'title' => 'Slow Requests',
                    'value' => number_format($slowRequests),
                    'icon' => 'exclamation-triangle',
                    'bgColor' => 'bg-accent-content',
                    'subtitle' => 'Execution time exceeded threshold',
                ],
                [
                    'title' => 'Total Data Sent',
                    'value' => "{$totalDataSent}MB",
                    'icon' => 'chart-bar',
                    'bgColor' => 'bg-accent-content',
                    'subtitle' => 'Total response data sent',
                ],
                [
                    'title' => 'Status Code 500s',
                    'value' => number_format($status500s),
                    'icon' => 'bug-ant',
                    'bgColor' => 'bg-accent-content',
                    'trend' => $this->calculateTrend($status500s, $yesterdayStatus500s),
                    'subtitle' => 'Internal server errors',
                ],
            ]
        ])->layout('laramon::layouts.app');
    }

    /**
     * Calculate trend percentage change.
     */
    private function calculateTrend($current, $previous): ?int
    {
        if ($previous == 0)
            return null;
        return round((($current - $previous) / $previous) * 100);
    }
}
