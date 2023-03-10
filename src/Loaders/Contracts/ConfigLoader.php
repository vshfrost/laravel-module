<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface ConfigLoader
{
    /**
     * Load configuration.
     * 
     * @param string $module
     */
    public function load(string $module): void;
}
