<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface RouteLoader
{
    /**
     * Load routes.
     * 
     * @param string $module
     */
    public function load(string $module): void;
}
