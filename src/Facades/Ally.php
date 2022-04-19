<?php

namespace StarfolkSoftware\Ally\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StarfolkSoftware\Ally\Ally
 */
class Ally extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ally';
    }
}
