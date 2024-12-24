<?php

/*
    Адаптер — это структурный паттерн проектирования, который позволяет 
    объектам с несовместимыми интерфейсами работать вместе.
*/

interface NativeWorker
{
    public function countSalary();
}

interface OutsourceWorket
{
    public function countSalaryByHour(int $hour);
}

class NativeDeveloper implements NativeWorker
{
    public function countSalary(): int
    {
        return 3000 * 20;
    }
}

class OutsourceWorker implements OutsourceWorket
{
    public function countSalaryByHour(int $hours): int
    {
        return $hours * 500;
    }
}

class OutsourceWorkerAdapter implements NativeWorker
{
    public function __construct(
        private OutsourceWorker $outsourceWorker
    ) {
    }

    public function countSalary(): int
    {
        return $this->outsourceWorker->countSalaryByHour(80);
    }
}

$nativeDeveloper = new NativeDeveloper();
$outsourceDeveloper = new OutsourceWorker();

$outsourceWorkerAdapter = new OutsourceWorkerAdapter($outsourceDeveloper);

$nativeDeveloper->countSalary(); // 60000
$outsourceWorkerAdapter->countSalary(); // 40000