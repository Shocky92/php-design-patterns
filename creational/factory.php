<?php

/*
    Фабрика — это шаблон проектирования, который помогает решить проблему 
    создания различных объектов в зависимости от некоторых условий. 
*/

class Worker
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class WorkerFactory
{
    public static function create(): Worker
    {
        return new Worker();
    }
}

$worker = WorkerFactory::create();
$worker->setName("Test");
$worker->getName(); // Test