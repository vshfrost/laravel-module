<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Contracts\Config\Repository as ConfigContract;
use Vshfrost\LaravelModule\Enums\Config;
use Vshfrost\LaravelModule\Exceptions\ConfigLoaderException;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\ConfigLoader as ConfigLoaderContract;
use Vshfrost\LaravelModule\Services\Contracts\ConfigSettingsService as SettingsServiceContract;

class ConfigLoader extends BaseLoader implements ConfigLoaderContract
{
    /**
     * Config loader constructor.
     * @param ConfigContract $configurator
     * @param SettingsServiceContract $settingsService
     */
    public function __construct(
        protected ConfigContract $configurator,
        protected SettingsServiceContract $settingsService
    ) { 
    }

    /**
     * Handle configuration loader logic.
     */
    protected function handle(): void 
    {
        $this->loadBase();
        $configs = StructureHelper::contains($this->pathTo, fn (string $file) => $file !== Config::ModuleFile->value);
        $this->loadRecursive($configs);
    }

    /**
     * Load base module configuration.
     * Set the default or redefined module config.
     */
    protected function loadBase(): void
    {
        $this->set(
            $this->settingsService->key($this->module, Config::ModuleKey->value),
            Config::ModuleDefaultKey->value, 
            $this->pathTo . Config::ModuleFile->value
        );
    }

    /**
     * Load all module configuration.
     * 
     * @param array $configs
     * @param string $inFolder
     */
    protected function loadRecursive(array $configs, string $inFolder = ''): void
    {
        $isTreeStructure = $this->settingsService->isTreeStructure($this->module);
        foreach ($configs as $config) {
            $relativeConfigPath = "$inFolder$config";
            $fullPath           = "$this->pathTo$relativeConfigPath";

            if (!is_dir($fullPath)) {
                $configKey = $this->settingsService->keyByPath($this->module, $relativeConfigPath);
                $this->set($configKey, $configKey, $fullPath);
            }

            if ($isTreeStructure) {
                $relativeConfigPath .= DIRECTORY_SEPARATOR;
                $fullPath           .= DIRECTORY_SEPARATOR;
                $this->loadRecursive(StructureHelper::contains($fullPath), $relativeConfigPath);
            }
        }
    }

    /**
     * Configuration setter.
     * 
     * @param string $moduleKey
     * @param string $loadedKey
     * @param string $path
     * 
     * @throws ConfigLoaderException
     */
    protected function set(string $moduleKey, string $loadedKey, string $path): void
    {
        try {
            $this->configurator->set(
                $moduleKey, 
                array_merge(
                    $this->configurator->get($loadedKey, []),
                    file_exists($path) ? require $path : []
                )
            );
        } catch (\Exception $exception) {
            throw new ConfigLoaderException($exception->getMessage());
        }
    }

    /**
     * Get path to content are being loaded.
     * 
     * @param string $module
     * @return string
     */
    protected function pathToLoadingContent(string $module): string
    {
        return StructureHelper::configPath($module);
    }
}
