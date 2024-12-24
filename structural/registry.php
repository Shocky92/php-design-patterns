<?php

/*
    Для реализации централизованного хранения объектов, часто используемых во всем 
    приложении, как правило, реализуется с помощью абстрактного класса только c 
    статическими методами (или с помощью шаблона Singleton). Помните, что это вводит 
    глобальное состояние, которого следует избегать. Используйте Dependency Injection 
    вместо Registry.
*/

abstract class Registry
{
    private static array $services = [];

    final public static function setService($key, Service $service)
    {
        self::$services[$key] = $service;
    }

    final public static function getService($key): ?Service
    {
        if (isset(self::$services[$key])) {
            return self::$services[$key];
        }

        return null;
    }
}

class Service
{
}

$service = new Service();
Registry::setService(1, $service);
$service = Registry::getService(1); // obj Service