<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class UpdateRssFeed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        if($event instanceof ArticleCreated ||
            $event instanceof ArticleDeleted)
        {
            Artisan::call('generate:feed' );
        }
    }
}
