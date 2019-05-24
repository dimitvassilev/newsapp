<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ArticleDeleted
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
