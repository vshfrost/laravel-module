<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface ConfigLoader
{
    /**
     * Load configurations.
     */
    public function load(string $module): void;
}
