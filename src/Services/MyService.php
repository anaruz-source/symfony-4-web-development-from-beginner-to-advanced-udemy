<?php

namespace App\Services;

class MyService
{
    use OptionalServiceTrait;

    public $my;
    public $logger;
    public $argService;

    public function __construct($param, $adminEmail, $global, $argService)
    {
        $this->argService = $argService;
        dump($param, $adminEmail, $global, $argService);
    }

    public function dumpProps()
    {
        dump($this->my, $this->logger);
    }
}
