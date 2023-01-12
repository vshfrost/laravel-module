<?php

namespace Vshfrost\LaravelModule\Loaders;

abstract class BaseLoader
{
    /**
     * Module name.
     */
    private string $module = '';

    /**
     * Path to loading content.
     */
    private string $pathTo = '';

    /**
     * Get loader props.
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->{$name};
    }

    /**
     * Load content.
     * 
     * @param string $module
     */
    public function load(string $module): void
    {
        $this->setBaseLoaderParams($module);
        $this->handle();
    }

    /**
     * Set base loader parameters.
     * 
     * @param string $module
     */
    private function setBaseLoaderParams(string $module): void
    {
        $this->module = $module;
        $this->pathTo = $this->pathToLoadingContent($this->module);
    }

    /**
     * Get path to content are being loaded.
     * 
     * @param string $module
     * @return string
     */
    abstract protected function pathToLoadingContent(string $module): string;
    
    /**
     * Handle content loader logic.
     */
    abstract protected function handle(): void;
}
