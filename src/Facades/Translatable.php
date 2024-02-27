<?php

namespace Translatable\Translatable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Translatable\Translatable\Translatable
 */
class Translatable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Translatable\Translatable\Translatable::class;
    }
}
