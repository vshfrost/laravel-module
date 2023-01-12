<?php

namespace Vshfrost\LaravelModule\Services;

use Illuminate\Support\Str;
use Vshfrost\LaravelModule\Services\Contracts\TranslationSettingsService as TranslationSettingsServiceContract;

class TranslationSettingsService implements TranslationSettingsServiceContract
{
    /**
     * Generate module translation namespace.
     * 
     * @param string $module
     * @return string
     */
    public function namespace(string $module): string
    {
        return Str::studly($module);
    }
}
