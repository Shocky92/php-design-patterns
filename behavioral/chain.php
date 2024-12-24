<?php

/*
    Цепочка обязанностей — это поведенческий паттерн проектирования, который 
    позволяет передавать запросы последовательно по цепочке обработчиков. 
    Каждый последующий обработчик решает, может ли он обработать запрос сам 
    и стоит ли передавать запрос дальше по цепи.
*/

abstract class Handler
{
    public function __construct(
        private ?Handler $successor
    ) {
    }

    final public function handle(TaskInterface $task)
    {
        $proceed = $this->processing($task);

        if ($proceed === null && $this->successor) {
            $proceed = $this->successor->handle($task);
        }

        return $proceed;
    }

    abstract public static function processing(TaskInterface $task): ?array;
}

interface TaskInterface
{
    public function getArray(): array;
}

class DevTask implements TaskInterface
{
    public function getArray(): array
    {
        return [1, 2, 3];
    }
}

class Junior extends Handler
{
    public static function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Middle extends Handler
{
    public static function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Senior extends Handler
{
    public static function processing(TaskInterface $task): ?array
    {
        return $task->getArray();
    }
}

$task = new DevTask();

$senior = new Senior(null);
$middle = new Middle($senior);
$junior = new Junior($middle);

$junior->handle($task); // junior -> middle -> senior