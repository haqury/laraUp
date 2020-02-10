<?php
namespace App\Service;

/**
 * Class Service
 * @package App\Service
 *
 * @method BladeService blade
 * @method FormService form
 */
class Service
{
    static protected $services = [];

    public static function __callStatic($name, $arguments)
    {
        $serviceName = 'App\Service\\' . ucfirst($name) . 'Service';
        if (!empty(self::$services[$name])) {
            return self::$services[$name];
        }
        self::$services[$name] = new $serviceName();
        return self::$services[$name];
    }
}