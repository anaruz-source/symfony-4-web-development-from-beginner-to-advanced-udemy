<?php

namespace App\Listeners;

class VideoCreatedListener
{
    public function videoCreated($event)
    {
        dump($event);
    }
}
