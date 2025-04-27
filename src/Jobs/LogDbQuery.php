<?php

namespace Ansuman\LaraMon\Jobs;

use Ansuman\LaraMon\Models\LaraMonDbQuery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogDbQuery implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $query;
    public $executionTime;
    public $queryType;

    public function __construct($query, $executionTime, $queryType)
    {
        $this->query = $query;
        $this->executionTime = $executionTime;
        $this->queryType = $queryType;
    }

    public function handle()
    {
        LaraMonDbQuery::create([
            'query' => $this->query,
            'execution_time' => $this->executionTime,
            'query_type' => $this->queryType,
        ]);
    }
}
