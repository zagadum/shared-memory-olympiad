<?php

namespace MemoryOlympiad;

use Illuminate\Support\ServiceProvider;

class MemoryOlympiadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/memory_olympiad');
    }

    public function register()
    {
        //
    }
}
