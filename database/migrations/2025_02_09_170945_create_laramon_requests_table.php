<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laramon_requests', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD']);
            $table->unsignedSmallInteger('status_code');
            $table->double('execution_time', 10, 6);
            $table->unsignedInteger('memory_usage');
            $table->boolean('is_slow')->default(false);
            $table->string('ip_address')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->text('headers')->nullable();
            $table->json('request_body')->nullable();
            $table->integer('response_size')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            //index columns
            $table->index('is_slow');
            $table->index('status_code');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laramon_requests');
    }
};
