<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface MigrationLoader
{
    /**
     * Load migration.
     * 
     * @param string $module
     */
    public function load(string $module): void;
}
