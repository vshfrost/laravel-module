<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Console\Application as Artisan;
use Vshfrost\LaravelModule\Loaders\Contracts\CommandLoader as CommandLoaderContract;
use Vshfrost\LaravelModule\Services\Contracts\CommandSettingsService as SettingsServiceContract;

class CommandLoader extends BaseLoader implements CommandLoaderContract
{
    /**
     * Command loader constructor.
     * @param SettingsServiceContract $settingsService
     */
    public function __construct(protected SettingsServiceContract $settingsService) 
    { 
    }

    /**
     * Handle commands loader logic.
     */
    protected function handle(): void
    {
        Artisan::starting(
            fn (Artisan $application) => 
                $application->resolveCommands($this->settingsService->commandList($this->module))
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
        return '';
    }
}
