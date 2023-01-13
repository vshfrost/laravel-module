<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface CommandLoader
{
    /**
     * Load command.
     * 
     * @param string $module
     */
    public function load(string $module): void;
}
