<?php

namespace Ansuman\LaraMon\Http\Livewire\Pages;

use Ansuman\LaraMon\Models\LaraMonRequest;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render(): mixed
    {
        $today = Carbon::today();

        $totalRequests = LaraMonRequest::count();
        $uniqueUsers = LaraMonRequest::distinct('user_id')->count('user_id');
        $avgResponseTime = round(LaraMonRequest::avg('execution_time'), 2);
        $slowRequests = LaraMonRequest::where('is_slow', true)->count();
        $totalDataSent = round(LaraMonRequest::sum('response_size') / 1024 / 1024, 2);
        $status500s = LaraMonRequest::where('status_code', 500)->count();

        return view('laramon::livewire.pages.dashboard', [
            'stats' => [
                [
                    'title' => 'Total Requests',
                    'value' => number_format($totalRequests),
                    'icon' => 'server',
                    'bgColor' => 'bg-accent-content',
                    'subtitle' => 'Total Request(all time)',
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
                    'subtitle' => 'Avg response time today vs all time',
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
                    'subtitle' => '500 Errors today vs all time',
                ],
            ]
        ])->layout('laramon::layouts.app');
    }

}
