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
     * Default module configuration key.
     */
    case ModuleKey           = 'module.default';

    /**
     * Module structure configuration key.
     */
    case ModuleStructureKey  = 'module.structure';
}
