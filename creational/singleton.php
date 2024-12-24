<?php

/*
    Одиночка — это порождающий паттерн проектирования,
    который гарантирует, что у класса есть только один
    экземпляр, и предоставляет к нему глобальную
    точку доступа.

    https://refactoring.guru/ru/design-patterns/singleton
*/

final class Connection
{
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __clone()
    {
    }
    public function __wakeup()
    {
    }
    private function __construct()
    {
    }
}

$connection = Connection::getInstance();
$connection2 = Connection::getInstance(); // same as $connection