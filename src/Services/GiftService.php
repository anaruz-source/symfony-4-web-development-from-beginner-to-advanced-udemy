<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class GiftService
{
    public $gifts = ['Flowers', 'Car', 'Piano', 'Money'];

    public function __construct(LoggerInterface $logger)
    {
        shuffle($this->gifts);
        $logger->info('gift array were randomized');
    }
}
