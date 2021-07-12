<?php

namespace App\Services;

class GiftService
{
    public $gifts = ['Flowers', 'Car', 'Piano', 'Money'];

    public function __construct()
    {
        shuffle($this->gifts);
    }
}
