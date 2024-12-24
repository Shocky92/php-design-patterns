<?php

/*
    Прототип — это порождающий паттерн проектирования, который позволяет копировать объекты,
    не вдаваясь в подробности их реализации.
*/

abstract class WorkerPrototype
{
    protected string $name;
    protected string $position;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}

class Developer extends WorkerPrototype
{
    protected string $position = 'Developer';
}

$developer = new Developer();
$developer->setName('Simon');
$developer->getName(); // Simon

$developer2 = clone $developer;
$developer2->setName('Andrew');
$developer2->getName(); // Andrew