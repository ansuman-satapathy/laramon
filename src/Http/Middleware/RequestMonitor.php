<?php

namespace Ansuman\LaraMon\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Ansuman\LaraMon\Jobs\LogRequestJob;

class RequestMonitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        $logData = $this->prepareLogData($request, $response, $startTime, $startMemory);

        $config = config('laramon');
        $useQueue = $config['use_queue'] ?? false;
        $rateLimitWindow = $config['rate_limit_window'] ?? 10;

        if ($this->shouldLogRequest($request, $config, $logData['execution_time'])) {
            if (!$this->isRateLimited($logData, $rateLimitWindow)) {
                $this->logRequest($logData, $useQueue);
            }
        }

        return $response;
    }

    /**
     * Prepare log data for insertion.
     */
    private function prepareLogData(Request $request, Response $response, float $startTime, int $startMemory): array
    {
        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $memoryUsed = round((memory_get_usage() - $startMemory) / 1024, 2);
        $statusCode = $response->getStatusCode();
        $responseSize = $response->getContent() ? strlen($response->getContent()) / 1024 : null;

        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $headers = base64_encode(json_encode($request->headers->all(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        $requestBody = json_encode($request->except(['password', 'password_confirmation']), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if (strlen($requestBody) > 5000) {
            $requestBody = substr($requestBody, 0, 5000) . '... (truncated)';
        }

        $enableAuthLogging = config('laramon.logging_rules.enable_auth_logging', false);
        $userId = $enableAuthLogging && Auth::check() ? Auth::id() : null;

        return [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'status_code' => $statusCode,
            'execution_time' => $executionTime,
            'memory_usage' => $memoryUsed,
            'is_slow' => $executionTime > config('laramon.logging_rules.log_slow_threshold', 1000),
            'ip_address' => $ipAddress,
            'headers' => $headers,
            'user_id' => $userId,
            'request_body' => $requestBody,
            'response_size' => $responseSize,
            'user_agent' => $userAgent,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Determines if the request should be logged based on config settings.
     */
    private function shouldLogRequest(Request $request, array $config, float $executionTime): bool
    {
        $loggingRules = $config['logging_rules'];
        $ignoredRoutes = $loggingRules['ignore_patterns'] ?? [];

        foreach ($ignoredRoutes as $route) {
            if ($request->is($route)) {
                return false;
            }
        }

        return $loggingRules['log_all_requests'] ?? true || $executionTime > ($loggingRules['log_slow_threshold'] ?? 1000);
    }

    /**
     * Check if request should be rate-limited.
     */
    private function isRateLimited(array $logData, int $rateLimitWindow): bool
    {
        return DB::table('laramon_requests')
            ->where('url', $logData['url'])
            ->where('method', $logData['method'])
            ->where('status_code', $logData['status_code'])
            ->where('ip_address', $logData['ip_address'])
            ->where('user_id', $logData['user_id'])
            ->where('created_at', '>=', now()->subSeconds($rateLimitWindow))
            ->exists();
    }

    /**
     * Log request to database (directly or via queue).
     */
    private function logRequest(array $logData, bool $useQueue): void
    {
        if ($useQueue && config('queue.default') !== 'sync') {
            dispatch(new LogRequestJob($logData))->onQueue('default');
        } else {
            DB::table('laramon_requests')->insert($logData);
        }
    }
}
