<?php

namespace App\Providers;

use App\Base\BaseObserver;
use App\Modules\User\Model\User;
use App\Modules\User\Observer\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // override abstract observer
        User::observe(UserObserver::class);
    }
}
