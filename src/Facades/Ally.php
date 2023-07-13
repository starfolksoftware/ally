<?php

namespace Ally\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ally\Ally
 */
class Ally extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ally';
    }
}
