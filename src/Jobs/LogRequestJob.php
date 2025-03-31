<?php

namespace Ansuman\LaraMon\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $logData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $logData)
    {
        $this->logData = $logData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            DB::table('laramon_requests')->insert($this->logData);
        } catch (\Exception $e) {
            Log::error('LaraMon: Failed to log request', [
                'error' => $e->getMessage(),
                'log_data' => $this->logData
            ]);
        }
    }
}
