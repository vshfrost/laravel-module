<?php

namespace Vshfrost\LaravelModule\Services\Contracts;

interface TranslationSettingsService
{
    /**
     * Generate module translation namespace.
     * 
     * @param string $module
     * @return string
     */
    public function namespace(string $module): string;
}
