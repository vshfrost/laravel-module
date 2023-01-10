<?php

namespace Vshfrost\LaravelModule;

use Illuminate\Support\ServiceProvider;
use Vshfrost\LaravelModule\Enums\Config;
use Vshfrost\LaravelModule\Loaders\ConfigLoader;
use Vshfrost\LaravelModule\Loaders\Contracts\ConfigLoader as ConfigLoaderContract;

class LaravelModuleServiceProvider extends ServiceProvider
{
    /**
     * Directory with the default configurations. 
     */
    protected const CONFIG_DIR = __DIR__ . '/../config/';

    /**
     * The Laravel module loaders.
     */
    private array $packageLoaders = [
        ConfigLoaderContract::class => ConfigLoader::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindLoaders();
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadDefaultConfig();
    }

    /**
     * Loaders list.
     * 
     * @return array
     */
    protected function loaders(): array
    {
        return $this->packageLoaders;
    }
    
    /**
     * Bind loaders.
     */
    private function bindLoaders(): void
    {
        foreach ($this->loaders() as $contract => $loader) {
            $this->app->bind($contract, $loader);
        }
    }

    /**
     * Load default configurations.
     */
    private function loadDefaultConfig(): void
    {
        $this->mergeConfigFrom(
            self::CONFIG_DIR . Config::ModuleFile->value, 
            Config::ModuleKey->value
        );
        $this->mergeConfigFrom(
            self::CONFIG_DIR . Config::ModuleStructureFile->value, 
            Config::ModuleStructureKey->value
        );
    }
}
