<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleCreated
{
    use SerializesModels;

    public $article;

    /**
     * Create a new event instance.
     *
     * @param $article
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

}
