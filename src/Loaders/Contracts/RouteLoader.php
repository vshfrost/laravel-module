<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface RouteLoader
{
    /**
     * Load routes.
     */
    public function load(string $module): void;
}
