<?php

/*
    Декоратор — это структурный паттерн проектирования, который позволяет 
    динамически добавлять объектам новую функциональность, 
    оборачивая их в полезные «обёртки».
*/

interface Worker
{
    public function countSalary();
}

abstract class WorkerDecorator implements Worker
{
    public function __construct(
        public Worker $worker
    ) {
    }
}

class Developer implements Worker
{
    public function countSalary()
    {
        return 20 * 3000;
    }
}

class DeveloperOverTime extends WorkerDecorator
{
    public function countSalary()
    {
        return $this->worker->countSalary() + $this->worker->countSalary() * 0.2;
    }
}

class DeveloperOverOverTime extends WorkerDecorator
{
    public function countSalary()
    {
        return $this->worker->countSalary() + $this->worker->countSalary() * 0.4;
    }
}

$developer = new Developer('Test');
$developerOverTime = new DeveloperOverTime($developer);
$developerOverOverTime = new DeveloperOverOverTime($developer);

$developer->countSalary(); // 60000
$developerOverTime->countSalary(); // 72000
$developerOverOverTime->countSalary(); // 84000