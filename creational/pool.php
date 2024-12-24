<?php

/*
    Объектный пул — порождающий шаблон проектирования, набор инициализированных 
    и готовых к использованию объектов. Когда системе требуется объект, он не создаётся, 
    а берётся из пула. Когда объект больше не нужен, он не уничтожается, 
    а возвращается в пул. 
*/

class WorkerPool
{
    private array $freeWorkers = [];
    private array $busyWorkers = [];

    public function setFreeWorkers(array $freeWorkers): void
    {
        $this->freeWorkers = $freeWorkers;
    }

    public function getFreeWorkers(): array
    {
        return $this->freeWorkers;
    }

    public function setBusyWorkers(array $busyWorkers): void
    {
        $this->busyWorkers = $busyWorkers;
    }

    public function getBusyWorkers(): array
    {
        return $this->busyWorkers;
    }

    public function getWorker(): Worker
    {
        if (count($this->freeWorkers) === 0) {
            $worker = new Worker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->busyWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function release(Worker $worker)
    {
        $key = spl_object_hash($worker);

        if (isset($this->busyWorkers[$key])) {
            unset($this->busyWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }
}

class Worker
{
    public function work()
    {
        echo "working";
    }
}

$pool = new WorkerPool();

$worker = $pool->getWorker();
$worker->work(); // working

$pool->getBusyWorkers(); // [hash => object]
$pool->getFreeWorkers(); // []