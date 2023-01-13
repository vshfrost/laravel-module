<?php

namespace Vshfrost\LaravelModule\Services;

use Illuminate\Support\Str;
use Vshfrost\LaravelModule\Enums\Config;
use Vshfrost\LaravelModule\Services\Contracts\ConfigSettingsService;
use Vshfrost\LaravelModule\Services\Contracts\RouteSettingsService as RouteSettingsServiceContract;

class RouteSettingsService implements RouteSettingsServiceContract
{
    /**
     * Default period for route limitation in minutes.
     */
    protected const DEFAULT_LIMIT_PERIOD = 0;

    /**
     * Default requests count for route limitation.
     */
    protected const DEFAULT_LIMIT_REQUESTS_COUNT = 0;

    /**
     * Route settings service constructor.
     * @param ConfigSettingsService $configSettingsService
     */
    public function __construct(protected ConfigSettingsService $configSettingsService) 
    { 
    }

    /**
     * Module routes alias.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    public function alias(string $module, string $routesType): string
    {
        return Str::finish(
            config(
                $this->configKey($module, "routes.$routesType.alias"),
                $this->defaultAlias($module, $routesType)
            ), 
            '.'
        );
    }

    /**
     * Default module routes alias.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    protected function defaultAlias(string $module, string $routesType): string
    {
        return Str::lower($routesType . '.' . Str::kebab($module));
    }

    /**
     * Is module routes limitated?
     * 
     * @param string $module
     * @param string $routesType
     * @return bool
     */
    public function isLimitated(string $module, string $routesType): bool
    {
        return !empty(config($this->configKey($module, "routes.$routesType.limit")));
    }

    /**
     * Module routes period for limitation in minutes.
     * 
     * @param string $module
     * @param string $routesType
     * @return int
     */
    public function limitPeriod(string $module, string $routesType): int
    {
        return config($this->configKey($module, "routes.$routesType.limit.in"), static::DEFAULT_LIMIT_PERIOD);
    }
    
    /**
     * Module routes requests count for limitation.
     * 
     * @param string $module
     * @param string $routesType
     * @return int
     */
    public function limitRequestsCount(string $module, string $routesType): int
    {
        return config(
            $this->configKey($module, "routes.$routesType.limit.count"), 
            static::DEFAULT_LIMIT_REQUESTS_COUNT
        );
    }

    /**
     * Module routes middleware.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    public function middleware(string $module, string $routesType): string
    {
        return config(
            $this->configKey($module, "routes.$routesType.middleware"),
            $this->defaultMiddleware($module, $routesType)
        );
    }
    
    /**
     * Module middleware list.
     * 
     * @param string $module
     * @return array
     */
    public function middlewareList(string $module): array
    {
        return config($this->configKey($module, 'middleware'), []);
    }

    /**
     * Default module routes middleware.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    protected function defaultMiddleware(string $module, string $routesType): string
    {
        return Str::lower(Str::kebab($module) . '.' . $routesType);
    }

    /**
     * Module routes prefix.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    public function prefix(string $module, string $routesType): string
    {
        return config(
            $this->configKey($module, "routes.$routesType.prefix"),
            $this->defaultPrefix($module, $routesType)
        );
    }

    /**
     * Default module routes prefix.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    protected function defaultPrefix(string $module, string $routesType): string
    {
        return Str::lower($routesType . '/' . Str::kebab($module));
    }

    /**
     * Module routes type by routes file name.
     * 
     * @param string $routesFile
     * @return string
     */
    public function type(string $routesFile): string
    {
        return Str::beforeLast($routesFile, '.');
    }

    /**
     * Configuration key for routes.
     * 
     * @param string $module
     * @param string $key
     * @return string
     */
    private function configKey(string $module, string $key): string
    {
        return $this->configSettingsService->key($module, Config::ModuleKey->value . ".$key");
    }
}
