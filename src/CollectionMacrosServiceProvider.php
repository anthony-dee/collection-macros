<?php

namespace AnthonyDee\CollectionMacros;

use AnthonyDee\CollectionMacros\Macros\PluckThenGroupBy;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Collection;

/**
 * @mixin \Illuminate\Support\Collection
 */
class CollectionMacrosServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        foreach ($this->macros() as $macro => $class) {
            if (! Collection::hasMacro($macro)) {
                Collection::macro($macro, app($class)());
            }
        }
    }

    public function macros()
    {
        return [
            'pluckThenGroupBy' => PluckThenGroupBy::class
        ];
    }
}
