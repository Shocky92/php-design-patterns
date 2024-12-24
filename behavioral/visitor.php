<?php

/*
    Посетитель — это поведенческий паттерн проектирования, который позволяет 
    добавлять в программу новые операции, не изменяя классы объектов, 
    над которыми эти операции могут выполняться.
*/

interface WorkerVisitor
{
    public function visitDeveloper(Worker $worker);
    public function visitDesigner(Worker $worker);
}

class RecorderVisitor implements WorkerVisitor
{
    private array $visited = [];

    public function getVisited(): array
    {
        return $this->visited;
    }

    public function visitDeveloper(Worker $developer): void
    {
        $this->visited[] = $developer;
    }

    public function visitDesigner(Worker $designer): void
    {
        $this->visited[] = $designer;
    }
}

interface Worker
{
    public function work();
    public function accept(WorkerVisitor $visitor);
}

class Developer implements Worker
{
    public function work(): void
    {
        echo "developer is working";
    }

    public function accept(WorkerVisitor $visitor): void
    {
        $visitor->visitDeveloper($this);
    }
}

class Designer implements Worker
{
    public function work(): void
    {
        echo "designer is working";
    }

    public function accept(WorkerVisitor $visitor): void
    {
        $visitor->visitDesigner($this);
    }
}

$visitor = new RecorderVisitor();

$developer = new Developer();
$designer = new Designer();

$developer->accept($visitor);
$designer->accept($visitor);

$visitor->getVisited(); // object Developer, object Designer