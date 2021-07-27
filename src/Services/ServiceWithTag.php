<?php

namespace App\Services;

use Doctrine\ORM\Event\PostFlushEventArgs;

class ServiceWithTag
{
    public function __construct()
    {
        dump('Service with tag dumped');
    }

    // executed after a flush
    public function postFlush(PostFlushEventArgs $args)
    {
        dump('hello from flush', $args);
    }

    // executed after a cache clear

    public function clear()
    {
        dump('Clearing cache success!!!');
    }
}
