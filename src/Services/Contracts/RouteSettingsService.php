<?php

namespace Vshfrost\LaravelModule\Services\Contracts;

interface RouteSettingsService
{
    /**
     * Module routes alias.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    public function alias(string $module, string $routesType): string;

    /**
     * Is module routes limitated?
     * 
     * @param string $module
     * @param string $routesType
     * @return bool
     */
    public function isLimitated(string $module, string $routesType): bool;

    /**
     * Module routes period for limitation in minutes.
     * 
     * @param string $module
     * @param string $routesType
     * @return int
     */
    public function limitPeriod(string $module, string $routesType): int;

    /**
     * Module routes requests count for limitation.
     * 
     * @param string $module
     * @param string $routesType
     * @return int
     */
    public function limitRequestsCount(string $module, string $routesType): int;

    /**
     * Module routes middleware.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    public function middleware(string $module, string $routesType): string;

    /**
     * Module routes prefix.
     * 
     * @param string $module
     * @param string $routesType
     * @return string
     */
    public function prefix(string $module, string $routesType): string;

    /**
     * Module routes type by routes file name.
     * 
     * @param string $routesFile
     * @return string
     */
    public function type(string $routesFile): string;
}
