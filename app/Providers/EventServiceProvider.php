<?php

namespace App\Providers;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Listeners\DeleteNestedPhotos;
use App\Listeners\UpdateRssFeed;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ArticleCreated::class => [
            UpdateRssFeed::class
        ],
        ArticleDeleted::class => [
            UpdateRssFeed::class,
            DeleteNestedPhotos::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
