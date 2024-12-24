<?php

/*
    Снимок — это поведенческий паттерн проектирования, который позволяет сохранять 
    и восстанавливать прошлые состояния объектов, 
    не раскрывая подробностей их реализации.
*/

class Memento
{
    public function __construct(
        private State $state,
    ) {
    }

    public function getState(): State
    {
        return $this->state;
    }
}

enum State
{
    case CREATED;
    case IN_PROGRESS;
    case TEST;
    case DONE;

    public function slug(): string
    {
        return match ($this) {
            self::CREATED => "created",
            self::IN_PROGRESS => "in progress",
            self::TEST => "test",
            self::DONE => "done",
        };
    }
}

class Worker
{

}

class Task
{
    private State $state;

    public function create()
    {
        $this->state = State::CREATED;
    }

    public function inProgress()
    {
        $this->state = State::IN_PROGRESS;
    }

    public function test()
    {
        $this->state = State::TEST;
    }

    public function done()
    {
        $this->state = State::DONE;
    }

    public function saveToMemento(): Memento
    {
        return new Memento($this->state);
    }

    public function restoreFromMemento(Memento $memento): void
    {
        $this->state = $memento->getState();
    }

    public function getState(): State
    {
        return $this->state;
    }
}

$task = new Task();
$task->create();

$memento = $task->saveToMemento();
$memento->getState(); // State::CREATED