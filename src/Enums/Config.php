<?php

namespace Vshfrost\LaravelModule\Enums;

enum Config: string
{
    /**
     * Default module configuration file.
     */
    case ModuleFile          = 'module.php';

    /**
     * Module structure configuration file.
     */
    case ModuleStructureFile = 'structure.php';

    /**
     * Module configuration key.
     */
    case ModuleKey           = 'module';
    
    /**
     * Default module configuration key.
     */
    case ModuleDefaultKey    = 'module.default';

    /**
     * Module structure configuration key.
     */
    case ModuleStructureKey  = 'module.structure';
}
