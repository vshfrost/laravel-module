<?php

namespace Vshfrost\LaravelModule\Loaders;

use Illuminate\Database\Migrations\Migrator;
use Vshfrost\LaravelModule\Helpers\StructureHelper;
use Vshfrost\LaravelModule\Loaders\Contracts\MigrationLoader as MigrationLoaderContract;

class MigrationLoader extends BaseLoader implements MigrationLoaderContract
{
    /**
     * Project migrator.
     */
    protected Migrator $migrator;

    /**
     * Migration loader constructor.
     * @param Migrator $migrator
     */
    public function __construct() 
    { 
        $this->migrator = app('migrator');
    }

    /**
     * Handle migrations loader logic.
     */
    protected function handle(): void
    {
        $this->migrator->path($this->pathTo);
    }

    /**
     * Get path to content are being loaded.
     * 
     * @param string $module
     * @return string
     */
    protected function pathToLoadingContent(string $module): string
    {
        return StructureHelper::migrationsPath($module);
    }
}
