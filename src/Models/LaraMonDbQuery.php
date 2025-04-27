<?php

namespace Ansuman\LaraMon\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaraMonDbQuery extends Model
{
    use HasFactory;

    protected $table = 'laramon_db_queries';

    protected $fillable = [
        'query',
        'execution_time',
        'query_type',
    ];
}
