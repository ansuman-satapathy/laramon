<?php

namespace Ansuman\LaraMon\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaraMonRequest extends Model
{
    use HasFactory;

    protected $table = 'laramon_requests';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'url',
        'method',
        'status_code',
        'execution_time',
        'memory_usage',
        'is_slow',
        'ip_address',
        'user_id',
        'headers',
        'request_body',
        'response_size',
        'user_agent',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'execution_time' => 'float',
        'memory_usage' => 'integer',
        'is_slow' => 'boolean',
        'headers' => 'array',
        'request_body' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that made the request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
