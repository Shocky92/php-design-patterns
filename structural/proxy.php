<?php

/*
    Заместитель — это структурный паттерн проектирования, который позволяет 
    подставлять вместо реальных объектов специальные объекты-заменители. 
    Эти объекты перехватывают вызовы к оригинальному объекту, позволяя сделать 
    что-то до или после передачи вызова оригиналу.
*/

interface Worker
{
    public function closedHours(): int;
    public function countSalary(): int;
}

class WorkerOutsource implements Worker
{
    private array $hours = [];

    public function closedHours($hours): int
    {
        $this->hours[] = $hours;
    }

    public function countSalary(): int
    {
        return array_sum($this->hours) * 500;
    }
}

class WorkerProxy extends WorkerOutsource implements Worker
{
    private int $salary = 0;

    public function countSalary(): int
    {
        if ($this->salary === 0) {
            $this->salary = parent::countSalary();
        }

        return $this->salary;
    }
}

$workerProxy = new WorkerProxy();
$workerProxy->closedHours(10);
$workerProxy->countSalary(); // 5000