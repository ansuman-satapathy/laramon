<?php

namespace Ansuman\LaraMon\Http\Middleware;

use Ansuman\LaraMon\Jobs\LogDbQuery;
use Closure;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DbQueryMonitor
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next): Response
    {
        DB::listen(function ($query) {
            if ($query->time > config('laramon.slow_query_threshold')) {
                $useQueue = config('queue.default') !== 'sync';

                if ($useQueue) {
                    dispatch(new LogDbQuery($query->sql, $query->time, $query->connectionName))->onQueue('default');
                } else {
                    DB::table('laramon_db_queries')->insert([
                        'query' => $query->sql,
                        'execution_time' => $query->time,
                        'query_type' => $query->connectionName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        return $next($request);
    }
}
