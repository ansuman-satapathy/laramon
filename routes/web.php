<?php

use Ansuman\LaraMon\Http\Livewire\Pages\Dashboard;
use Ansuman\LaraMon\Http\Livewire\Pages\DatabaseQueryMonitoring;
use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(function () {
    Route::get('/laramon', Dashboard::class)->name('laramon.dashboard');
    Route::get('/database-queries', DatabaseQueryMonitoring::class)->name('database-queries');
    Route::get('/test-database-operation', function () {
        $data = \DB::table('laramon_requests')->get();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    })->name('test-database-operation');
});