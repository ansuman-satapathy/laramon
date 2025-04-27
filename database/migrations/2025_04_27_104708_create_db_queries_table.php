<?php
// database/migrations/2025_04_27_000000_create_db_queries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbQueriesTable extends Migration
{
    public function up()
    {
        Schema::create('laramon_db_queries', function (Blueprint $table) {
            $table->id();
            $table->text('query');
            $table->float('execution_time');
            $table->string('query_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('db_queries');
    }
}
