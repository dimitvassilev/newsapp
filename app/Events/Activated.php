<?php

namespace App\Events;

use App\Models\Interfaces\MustBeActivated;
use Illuminate\Queue\SerializesModels;

class Activated
{
    use SerializesModels;

    /**
     * The activated user.
     *
     * @var MustBeActivated
     */
    public $user;


    /**
     * Create a new event instance.
     *
     * @param MustBeActivated $user
     */
    public function __construct(MustBeActivated $user)
    {
        $this->user = $user;
    }

}
