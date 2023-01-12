<?php

namespace Vshfrost\LaravelModule\Providers;

use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Support\ServiceProvider;
use Vshfrost\LaravelModule\Exceptions\StructureException;
use Vshfrost\LaravelModule\Helpers\ReflectionHelper;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\ConfigLoader;
use Vshfrost\LaravelModule\Loaders\Contracts\RouteLoader;
use Vshfrost\LaravelModule\Loaders\Contracts\TranslationLoader;

abstract class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Module name.
     */
    private string $module;

    /**
     * Define a module realization for a contract.
     */
    protected array $bind = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRealizations();
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->beforeLoad();

        $this->loadConfig();
        $this->loadRoute();
        $this->loadTranslation();
    }

    /**
     * Bind the module realisations for the predefined contracts in the bind property.
     */
    protected function bindRealizations(): void
    {
        foreach ($this->bind as $contract => $realization) {
            $this->app->bind($contract, $realization);
        }
    }

    /**
     * Called first before all loads.
     * Found module name.
     */
    protected function beforeLoad(): void
    {
        $module       = StructureHelper::moduleName(ReflectionHelper::classPath($this));

        $this->module = $module ?: throw new StructureException('Can\'t identify the module name');
    }

    /**
     * Load module configurations.
     */
    protected function loadConfig(): void
    {
        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            $this->app->make(ConfigLoader::class)->load($this->module);
        }
    }
    
    /**
     * Load module routes.
     */
    protected function loadRoute(): void
    {
        $this->app->make(RouteLoader::class)->load($this->module);
    }
    
    /**
     * Load module translations.
     */
    protected function loadTranslation(): void
    {
        $this->callAfterResolving(
            'translator',
            fn () => $this->app->make(TranslationLoader::class)->load($this->module)
        );
    }
}
