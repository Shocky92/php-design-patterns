<?php

/*
    Подобно AbstractFactory, этот паттерн используется для создания ряда связанных 
    или зависимых объектов. Разница между этим шаблоном и Абстрактной Фабрикой 
    заключается в том, что Статическая Фабрика использует только один статический метод, 
    чтобы создать все допустимые типы объектов. 
    Этот метод, обычно, называется factory или build.
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

class WorkerFactory
{
    public static function make($workerTitle): ?Worker
    {
        $className = strtoupper($workerTitle);

        if (class_exists($className)) {
            return new $className;
        }

        return null;
    }
}

$developer = WorkerFactory::make("developer");
$developer->work(); // developer