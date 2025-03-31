<?php

namespace Ansuman\LaraMon;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LaraMonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laramon');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/../config/laramon.php', 'laramon');

        $this->publishes([
            __DIR__ . '/../config/laramon.php' => $this->app->configPath('laramon.php'),
        ], 'laramon-config');

        if (class_exists(Livewire::class)) {
            Livewire::component('laramon.dashboard', \Ansuman\LaraMon\Http\Livewire\Pages\Dashboard::class);
            Livewire::component('laramon.sidebar', \Ansuman\LaraMon\Http\Livewire\Components\Sidebar::class);
            Livewire::component('laramon.navbar', \Ansuman\LaraMon\Http\Livewire\Components\Navbar::class);
            Livewire::component('laramon.card', \Ansuman\LaraMon\Http\Livewire\Components\Card::class);
            Livewire::component('laramon.recent-requests-table', \Ansuman\LaraMon\Http\Livewire\Components\RecentRequestsTable::class);
        }
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        //
    }
}
