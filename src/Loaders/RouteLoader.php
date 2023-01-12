<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\RouteLoader as RouteLoaderContract;
use Vshfrost\LaravelModule\Services\Contracts\RouteSettingsService as SettingsServiceContract;

class RouteLoader extends BaseLoader implements RouteLoaderContract
{
    /**
     * Route loader constructor.
     * @param SettingsServiceContract $settingsService
     */
    public function __construct(protected SettingsServiceContract $settingsService) 
    { 
    }

    /**
     * Handle routes loader logic.
     */
    protected function handle(): void 
    {
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
     * Get path to content are being loaded.
     * 
     * @param string $module
     * @return string
     */
    protected function pathToLoadingContent(string $module): string
    {
        return StructureHelper::routesPath($module);
    }
}
