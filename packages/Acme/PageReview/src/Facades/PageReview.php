<?php

namespace Acme\PageReview\Facades;

use Illuminate\Support\Facades\Facade;

class PageReview extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pagereview';
    }
}
