<?php

namespace App\Providers;

use App\Repository\Eloquent\MeditationRecordRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\MeditationRecordRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(MeditationRecordRepositoryInterface::class,MeditationRecordRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
