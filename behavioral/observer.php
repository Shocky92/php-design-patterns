<?php

/*
    Наблюдатель — это поведенческий паттерн проектирования, который создаёт 
    механизм подписки, позволяющий одним объектам следить и реагировать на события, 
    происходящие в других объектах.
*/

class Worker implements SplSubject
{
    private string $name = '';

    public function __construct(
        private SplObjectStorage $observers
    ) {
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function changeName(string $name)
    {
        $this->name = $name;
        $this->notify();
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class WorkerObserver implements SplObserver
{
    private array $workers = [];

    public function update(SplSubject $subject)
    {
        $this->workers[] = clone $subject;
    }

    public function getWorkers(): array
    {
        return $this->workers;
    }
}

$observer = new WorkerObserver();
$worker = new Worker();
$worker->attach($observer);
$worker->changeName('Ben');

$observer->getWorkers(); // SplObserver class