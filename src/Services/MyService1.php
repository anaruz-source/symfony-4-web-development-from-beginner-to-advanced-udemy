<?php

namespace App\Services;

class MyService1 implements ServiceInterface
{
    public function __construct()
    {
        dump('MyService1 here!');
    }
}
