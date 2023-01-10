<?php

namespace Vshfrost\LaravelModule\Helpers;

use ReflectionClass;

class ReflectionHelper
{
    /**
     * Get path to class by an object or a class fully qualified name.
     * 
     * @param object|string $class
     * @return string
     */
    public static function classPath(object|string $class): string
    {
        try {
            $classPath = self::reflection($class)->getFileName();
        } catch (\Exception $exception) {
            $classPath = '';
        }

        return $classPath;
    }

    /**
     * Get reflection by an object or a class fully qualified name.
     * 
     * @param object|string $class
     * @return ReflectionClass
     */
    private static function reflection(object|string $class): ReflectionClass
    {
        return new ReflectionClass($class);
    }
}
