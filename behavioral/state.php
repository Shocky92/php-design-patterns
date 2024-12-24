<?php

/*
    Состояние — это поведенческий паттерн проектирования, который позволяет объектам 
    менять поведение в зависимости от своего состояния. Извне создаётся впечатление, 
    что изменился класс объекта.
*/

interface State
{
    public function getStatus();
    public function toNext(Task $task);
    public function toPrevious(Task $task);
}

class Task
{
    private State $state;

    public static function make(): self
    {
        $self = new self();
        $self->setState(new Created());

        return $self;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function proceedToNext()
    {
        $this->state->toNext($this);
    }

    public function proceedToPrevious()
    {
        $this->state->toPrevious($this);
    }
}

class Created implements State
{
    public function getStatus(): string
    {
        return "Created";
    }

    public function toNext(Task $task)
    {
        $task->setState(new InProgress());
    }

    public function toPrevious(Task $task)
    {
    }
}

class InProgress implements State
{
    public function getStatus(): string
    {
        return "In progress";
    }

    public function toNext(Task $task)
    {
        $task->setState(new Test());
    }

    public function toPrevious(Task $task)
    {
        $task->setState(new Created());
    }
}

class Test implements State
{
    public function getStatus(): string
    {
        return "In test";
    }

    public function toNext(Task $task)
    {
        $task->setState(new Done());
    }

    public function toPrevious(Task $task)
    {
        $task->setState(new InProgress());
    }
}

class Done implements State
{
    public function getStatus(): string
    {
        return "Done";
    }

    public function toNext(Task $task)
    {
    }

    public function toPrevious(Task $task)
    {
        $task->setState(new Test());
    }
}

$task = Task::make();
$task->getState()->getStatus(); // created
$task->proceedToNext();
$task->getState()->getStatus(); // in progress
$task->proceedToPrevious();
$task->getState()->getStatus(); // created
