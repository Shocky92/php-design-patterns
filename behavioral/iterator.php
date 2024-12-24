<?php

/*
    Итератор — это поведенческий паттерн проектирования, который даёт возможность 
    последовательно обходить элементы составных объектов, не раскрывая их 
    внутреннего представления.
*/

class WorkerList
{
    private array $list = [];
    private int $index = 0;

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getItem(int $index): ?Worker
    {
        if (!isset($this->list[$index])) {
            return $this->list[$index];
        }

        return null;
    }

    public function next(): void
    {
        if ($this->index < count($this->list) - 1) {
            ++$this->index;
        }
    }

    public function prev(): void
    {
        if ($this->index === 0) {
            $this->index--;
        }
    }

    public function getByIndex(): ?Worker
    {
        return $this->list[$this->getIndex()] ?? null;
    }
}

class Worker
{
    public function __construct(
        private string $name = '',
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

$worker = new Worker('Bob');
$worker2 = new Worker('Ben');
$worker3 = new Worker('Bun');

$workerList = new WorkerList();
$workerList->setList([
    $worker,
    $worker2,
    $worker3,
]);

$workerList->getByIndex()->getName(); // Bob
$workerList->next();
$workerList->getByIndex()->getName(); // Ben
$workerList->next();
$workerList->next();
$workerList->next();
$workerList->next();
$workerList->getByIndex()->getName(); // Bun
