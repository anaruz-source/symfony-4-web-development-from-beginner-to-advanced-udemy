<?php

namespace App\Services;

class ParamService implements ServiceInterface
{
    public function __construct()
    {
        dump('passed as param to Another Service(MyService)');
    }

    public function lazyLoaded()
    {
        return 'This service is Lazy loaded because it\'s heavy';
    }
}
