<?php

namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event; // in course they use Component instead of Contracts, the first isn't available

class VideoCreatedEvent extends Event
{
    private $video;

    public function __construct($video)
    {
        $this->video = $video;
    }
}
