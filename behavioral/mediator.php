<?php

/*
    Посредник — это поведенческий паттерн проектирования, который позволяет 
    уменьшить связанность множества классов между собой, благодаря перемещению 
    этих связей в один класс-посредник.
*/

interface Mediator
{
    public function getWorker();
}

abstract class Worker
{

    public function __construct(
        private string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function sayHello(): void
    {
        echo "Hello";
    }

    public function work(): string
    {
        return $this->name . ' is working';
    }
}

class InfoBase
{
    public function printInfo(Worker $worker): string
    {
        echo $worker->work();
    }
}

class WorkerInfoBaseMediator implements Mediator
{
    public function __construct(
        private Worker $worker,
        private InfoBase $infoBase,
    ) {

    }

    public function getWorker(): string
    {
        return $this->infoBase->printInfo($this->worker);
    }
}

class Developer extends Worker
{
}

$developer = new Developer('Bob');
$infoBase = new InfoBase();

$workerInfoBaseMediator = new WorkerInfoBaseMediator($worker, $infoBase);

$workerInfoBaseMediator->getWorker(); // Bob is working