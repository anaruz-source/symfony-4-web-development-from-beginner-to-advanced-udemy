<?php

namespace App\Services;

trait OptionalServiceTrait
{
    private $service;

    /**
     * @required
     */
    public function setService(ParamService $service)
    {
        $this->service = $service;
    }
}
