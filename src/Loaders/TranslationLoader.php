<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Contracts\Translation\Translator as TranslationContract;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\TranslationLoader as TranslationLoaderContract;
use Vshfrost\LaravelModule\Services\Contracts\TranslationSettingsService as SettingsServiceContract;

class TranslationLoader extends BaseLoader implements TranslationLoaderContract
{
    /**
     * Project translator.
     */
    protected TranslationContract $translator;

    /**
     * Translation loader constructor.
     * @param SettingsServiceContract $settingsService
     */
    public function __construct(protected SettingsServiceContract $settingsService) 
    { 
        $this->translator = app('translator');
    }

    /**
     * Handle translations loader logic.
     */
    protected function handle(): void
    {
        $this->translator->addNamespace($this->settingsService->namespace($this->module), $this->pathTo);
    }

    /**
     * Get path to content are being loaded.
     * 
     * @param string $module
     * @return string
     */
    protected function pathToLoadingContent(string $module): string
    {
        return StructureHelper::translationPath($module);
    }
}
