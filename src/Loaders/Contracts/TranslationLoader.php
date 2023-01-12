<?php

namespace Vshfrost\LaravelModule\Loaders\Contracts;

interface TranslationLoader
{
    /**
     * Load translation.
     * 
     * @param string $module
     */
    public function load(string $module): void;
}
