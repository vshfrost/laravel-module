<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\RouteLoader as RouteLoaderContract;
use Vshfrost\LaravelModule\Services\Contracts\RouteSettingsService;

class RouteLoader implements RouteLoaderContract
{
    /**
     * Module name.
     */
    private string $module = '';

    /**
     * Path to route directory.
     */
    private string $pathTo = '';

    /**
     * Route loader constructor.
     * @param RouteSettingsService $settingsService
     */
    public function __construct(protected RouteSettingsService $settingsService) 
    { 
    }

    /**
     * Load routes.
     * 
     * @param string $module
     */
    public function load(string $module): void 
    {
        $this->setLoaderProps($module);

        $routes = StructureHelper::contains($this->pathTo, fn (string $file) => !is_dir("$this->pathTo$file"));
        $this->loadFrom($routes);
    }

    /**
     * Load the routes from files.
     * 
     * @param array $routesFiles
     */
    protected function loadFrom(array $routesFiles): void
    {
        foreach ($routesFiles as $file) {
            $type = $this->settingsService->type($file);
            $this->loadRoutes("$this->pathTo$file", $type);
            $this->loadLimits($type);
        }
    }

    /**
     * Load the routes from file.
     * 
     * @param string $filePath
     * @param string $type
     */
    protected function loadRoutes(string $filePath, string $type): void
    {
        Route::middleware($this->settingsService->middleware($this->module, $type))
            ->prefix($this->settingsService->prefix($this->module, $type))
            ->as($this->settingsService->alias($this->module, $type))
            ->group($filePath);
    }

    /**
     * Load the routes limits for the alias.
     * 
     * @param string $type
     */
    protected function loadLimits(string $type): void
    {
        RateLimiter::for(
            $this->settingsService->alias($this->module, $type),
            fn (Request $request) => $this->settingsService->isLimitated($this->module, $type) 
                ? Limit::perMinutes(
                    $this->settingsService->limitPeriod($this->module, $type),
                    $this->settingsService->limitRequestsCount($this->module, $type)
                )->by($request->user()?->id ?: $request->ip())
                : Limit::none()
        );
    }

    /**
     * Set route loader properties.
     * Will be set module name, path to routes.
     * 
     * @param string $module
     */
    protected function setLoaderProps(string $module): void
    {
        $this->module = $module;
        $this->pathTo = StructureHelper::routesPath($this->module);
    }
}
