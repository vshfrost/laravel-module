<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Contracts\Translation\Translator as TranslationContract;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\TranslationLoader as TranslationLoaderContract;
use Vshfrost\LaravelModule\Services\Contracts\TranslationSettingsService as SettingsServiceContract;

class TranslationLoader extends BaseLoader implements TranslationLoaderContract
{
    /**
     * Translation loader constructor.
     * @param TranslationContract $translator
     * @param SettingsServiceContract $settingsService
     */
    public function __construct(
        protected TranslationContract $translator,
        protected SettingsServiceContract $settingsService
    ) { 
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
