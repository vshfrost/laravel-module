<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Support\Str;
use Vshfrost\LaravelModule\Enums\Config;
use Vshfrost\LaravelModule\Exceptions\ConfigLoaderException;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\ConfigLoader as ConfigLoaderContract;

class ConfigLoader implements ConfigLoaderContract
{
    /**
     * Module name.
     */
    private string $module = '';

    /**
     * Path to config directory.
     */
    private string $pathTo = '';

    /**
     * Config loader constructor.
     * @param ConfigContract $configurator
     */
    public function __construct(protected ConfigContract $configurator)
    { 
    }

    /**
     * Load configurations.
     * 
     * @param string $module
     */
    public function load(string $module): void 
    {
        $this->setLoaderProps($module);

        $this->loadBase();
        $configs = StructureHelper::contains($this->pathTo, fn (string $file) => $file !== Config::ModuleFile->value);
        $this->loadRecursive($this->pathTo, $configs);
    }

    /**
     * Load base module configuration.
     * Set the default or redefined module config.
     */
    protected function loadBase(): void
    {
        $this->set(
            $this->configKey(Str::beforeLast(Config::ModuleFile->value, '.')), 
            Config::ModuleKey->value, 
            $this->pathTo . Config::ModuleFile->value
        );
    }

    /**
     * Load all module configuration.
     * 
     * @param string $pathTo
     * @param array $configs
     */
    protected function loadRecursive(string $pathTo, array $configs): void
    {
        $isTreeStructure = config($this->configKey('module.config.tree_structure'));
        foreach ($configs as $config) {
            $path = "$pathTo$config";

            if (!is_dir($path)) {
                $configKey = $this->configKey(Str::beforeLast($config, '.'), $this->configKeyPrefix($pathTo));
                $this->set($configKey, $configKey, $path);
            }

            if ($isTreeStructure) {
                $path .= DIRECTORY_SEPARATOR;
                $this->loadRecursive($path, StructureHelper::contains($path));
            }
        }
    }

    /**
     * Configuration setter.
     * 
     * @param string $moduleKey
     * @param string $key
     * @param string $path
     * 
     * @throws ConfigLoaderException
     */
    protected function set(string $moduleKey, string $key, string $path): void
    {
        try {
            $this->configurator->set(
                $moduleKey, 
                array_merge(
                    $this->configurator->get($key, []),
                    $this->configurator->get($moduleKey, []),
                    file_exists($path) ? require $path : []
                )
            );
        } catch (\Exception $exception) {
            throw new ConfigLoaderException($exception->getMessage());
        }
    }

    /**
     * Set config loader properties.
     * Will be set module name, path to configs.
     * 
     * @param string $module
     */
    protected function setLoaderProps(string $module): void
    {
        $this->module = $module;
        $this->pathTo = StructureHelper::configPath($this->module);
    }

    /**
     * Generate configuration key.
     * 
     * @param string $key
     * @param string|null $prefix
     * @return string
     */
    protected function configKey(string $key, string $prefix = ''): string
    {
        return $this->module . config(Config::ModuleStructureKey->value . '.config.delimeter') . "$prefix$key";
    }
    
    /**
     * Generate configuration key prefix.
     * 
     * @param string $prefix
     * @return string
     */
    protected function configKeyPrefix(string $prefix): string
    {
        return str_replace(DIRECTORY_SEPARATOR, '.', Str::after($prefix, $this->pathTo));
    }
}
