<?php

use Ansuman\LaraMon\Http\Livewire\Pages\Dashboard;
use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(function () {
    Route::get('/laramon', Dashboard::class)->name('laramon.dashboard');
});