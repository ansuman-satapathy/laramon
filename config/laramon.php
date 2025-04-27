<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Log Retention Period
    |--------------------------------------------------------------------------
    | Defines how long logs should be kept before automatic deletion.
    | Logs older than the specified days will be purged via cron.
    */
    'log_retention_days' => 30, // Delete logs older than 30 days

    /*
    |--------------------------------------------------------------------------
    | Request Logging Behavior
    |--------------------------------------------------------------------------
    | - 'use_queue': Enables queue-based logging for better performance.
    | - 'rate_limit_window': Prevents duplicate logs within X seconds.
    */
    'use_queue' => true,  // Set to false to disable queue-based logging
    'rate_limit_window' => 10, // Time window to avoid duplicate logs (in seconds)

    /*
    |--------------------------------------------------------------------------
    | Logging Rules & Filters
    |--------------------------------------------------------------------------
    | - 'log_all_requests': Logs all requests if true; otherwise, only slow ones.
    | - 'log_slow_threshold': Defines what is considered a slow request (ms).
    | - 'enable_auth_logging': Logs user ID if authentication exists.
    | - 'ignore_patterns': Skip logging for specific URLs or patterns.
    */
    'logging_rules' => [
        'log_all_requests' => true, // Log all requests, unless ignored
        'log_slow_threshold' => 500, // Requests slower than 500ms are logged
        'enable_auth_logging' => false, // Log user ID if authenticated

        'ignore_patterns' => [
            '/health-check',   // Health check routes
            '/static/*',       // Static files
            '/images/*',       // Image files
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Query Logging
    |--------------------------------------------------------------------------
    | slow_query_threshold: Threshold for logging slow database queries (in ms).
    */
    'slow_query_threshold' => 300, // Threshold for slow queries in milliseconds

];
