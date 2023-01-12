<?php

namespace Vshfrost\LaravelModule\Helpers;

use Illuminate\Support\Str;
use Vshfrost\LaravelModule\Enums\Config;

class StructureHelper
{
    /**
     * Relative pathes in the os.
     */
    private const RELATIVE_PATHES = [
        '.',
        '..',
    ];

    /**
     * Get path to the module configuration folder.
     * 
     * @param string $module
     * @return string 
     */
    public static function configPath(string $module): string 
    {
        return self::modulePath($module, config(Config::ModuleStructureKey->value . '.path.config'));
    }
    
    /**
     * Get path to the module migrations folder.
     * 
     * @param string $module
     * @return string 
     */
    public static function migrationsPath(string $module): string 
    {
        return self::modulePath($module, config(Config::ModuleStructureKey->value . '.path.database.migrations'));
    }

    /**
     * Get path to the module routes folder.
     * 
     * @param string $module
     * @return string 
     */
    public static function routesPath(string $module): string 
    {
        return self::modulePath($module, config(Config::ModuleStructureKey->value . '.path.routes'));
    }
    
    /**
     * Get path to the module lang folder.
     * 
     * @param string $module
     * @return string 
     */
    public static function translationPath(string $module): string 
    {
        return self::modulePath($module, config(Config::ModuleStructureKey->value . '.path.resources.lang'));
    }

    /**
     * Get module name by the path to the module service provider.
     * 
     * @param string $moduleProviderPath
     * @return string
     */  
    public static function moduleName(string $moduleProviderPath): string 
    {
        return Str::before(
            Str::afterLast($moduleProviderPath, config(Config::ModuleStructureKey->value . '.path.root')), 
            DIRECTORY_SEPARATOR
        );
    }

    /**
     * Get path to the module placement by the module name. 
     * 
     * @param string $module
     * @param string $pathInModule
     * @return string
     */
    public static function modulePath(string $module, string $pathInModule = ''): string
    {
        $pathToModule = implode('', [
            config(Config::ModuleStructureKey->value . '.path.root'),
            $module,
            DIRECTORY_SEPARATOR,
        ]);

        return base_path("$pathToModule$pathInModule");
    }

    /**
     * Get the list of folders and files in the placement by the path.
     * 
     * @param string $path
     * @param callable|null $filter
     * @return array
     */
    public static function contains(string $path, callable $filter = null): array
    {
        return file_exists($path) 
            ? array_filter(
                array_diff(scandir($path), self::RELATIVE_PATHES), 
                $filter
            ) 
            : [];
    }
}
