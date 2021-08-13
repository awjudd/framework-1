<?php
namespace Haunt\Facades;

use Illuminate\Support\Facades\Facade;

class Haunt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Haunt\Haunt::class;
    }
}
