<?php

namespace amin3520\Anar\Facades;

use Illuminate\Support\Facades\Facade;

class Anar extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'anar';
    }
}
