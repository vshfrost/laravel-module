<?php

namespace Vshfrost\LaravelModule\Services\Contracts;

interface ConfigSettingsService
{
    /**
     * Generate the module configuration key
     * 
     * @param string $module
     * @param string $dottedPath
     * @return string
     */
    public function key(string $module, string $dottedPath): string;

    /**
     * Generate the module configuration key by file path.
     * 
     * @param string $module
     * @param string $filePath
     * @return string
     */
    public function keyByPath(string $module, string $filePath): string;
    
    /**
     * Is tree structure used
     * 
     * @param string $module
     * @return bool
     */
    public function isTreeStructure(string $module): bool;
}
