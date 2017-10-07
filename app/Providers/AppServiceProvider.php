<?php

namespace TMS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use TMS\Models\Observers\RecordObserver;
use TMS\Models\Observers\UserObserver;
use TMS\Models\User;
use TMS\Models\Observers\MemberObserver;
use TMS\Models\Member;
use TMS\Models\Record;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Member::observe(MemberObserver::class);
        Record::observe(RecordObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
