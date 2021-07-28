<?php

namespace App\Services;

class MyService2 implements ServiceInterface
{
    public function __construct()
    {
        dump('MyService2 Here!');
    }
}
