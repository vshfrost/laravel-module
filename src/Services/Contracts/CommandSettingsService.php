<?php

namespace Vshfrost\LaravelModule\Services\Contracts;

interface CommandSettingsService
{
    /**
     * Command namespaces list.
     * 
     * @param string $module
     * @return array
     */
    public function commandList(string $module): array;
}
