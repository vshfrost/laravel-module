<?php

namespace Vshfrost\LaravelModule\Services;

use Vshfrost\LaravelModule\Enums\Config;
use Vshfrost\LaravelModule\Services\Contracts\CommandSettingsService as CommandSettingsServiceContract;
use Vshfrost\LaravelModule\Services\Contracts\ConfigSettingsService;

class CommandSettingsService implements CommandSettingsServiceContract
{
    /**
     * Route settings service constructor.
     * @param ConfigSettingsService $configSettingsService
     */
    public function __construct(protected ConfigSettingsService $configSettingsService) 
    { 
    }

    /**
     * Command namespaces list.
     * 
     * @param string $module
     * @return array
     */
    public function commandList(string $module): array
    {
        return config($this->configSettingsService->key($module, Config::ModuleKey->value . '.commands'), []);
    }
}
