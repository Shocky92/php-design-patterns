<?php

/*
    Фабричный метод — это порождающий паттерн проектирования, 
    который определяет общий интерфейс для создания объектов в суперклассе, 
    позволяя подклассам изменять тип создаваемых объектов.
*/

interface Worker
{
    public function work();
}

class Developer implements Worker
{
    public function work()
    {
        echo "developer";
    }
}

class Designer implements Worker
{
    public function work()
    {
        echo "designer";
    }
}

interface WorkerFactory
{
    public static function create();
}

class DeveloperFactory implements WorkerFactory
{
    public function create()
    {
        return new Developer();
    }
}

class DesignerFactory implements WorkerFactory
{
    public function create()
    {
        return new Designer();
    }
}

$developerFactory = new DeveloperFactory();
$designerFactory = new DesignerFactory();

$developer = $developerFactory->create();
$designer = $designerFactory->create();

$developer->work(); // developer
$designer->work(); // designer