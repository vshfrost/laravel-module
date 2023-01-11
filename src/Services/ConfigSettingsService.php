<?php

namespace Vshfrost\LaravelModule\Services;

use Illuminate\Support\Str;
use Vshfrost\LaravelModule\Enums\Config;
use Vshfrost\LaravelModule\Services\Contracts\ConfigSettingsService as ConfigSettingsServiceContract;

class ConfigSettingsService implements ConfigSettingsServiceContract
{
    /**
     * Generate the module configuration key.
     * 
     * @param string $module
     * @param string $dottedPath
     * @return string
     */
    public function key(string $module, string $dottedPath): string
    {
        return $module . config(Config::ModuleStructureKey->value . '.config.delimeter') . $dottedPath;
    }
    
    /**
     * Generate the module configuration key by file path.
     * 
     * @param string $module
     * @param string $filePath
     * @return string
     */
    public function keyByPath(string $module, string $filePath): string
    {
        return $this->key($module, Str::replace(DIRECTORY_SEPARATOR, '.', Str::beforeLast($filePath, '.')));
    }
    
    /**
     * Is tree structure used.
     * 
     * @param string $module
     * @return bool
     */
    public function isTreeStructure(string $module): bool
    {
        return config($this->key($module, Config::ModuleKey->value . '.config.tree_structure'), false);
    }
}
