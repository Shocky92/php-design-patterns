<?php

/*
    Null Object — это объект с определенным нейтральным («null») поведением. 
    Шаблон проектирования Null Object описывает использование таких объектов и 
    их поведение (или отсутствие такового).
*/

interface Worker
{
    public function work();
}

class ObjectManager
{
    public function __construct(
        private Worker $worker
    ) {
    }

    public function goWork()
    {
        $this->worker->work();
    }
}

class Developer implements Worker
{
    public function work()
    {
        echo "Developer working";
    }
}

class NullWorker implements Worker
{
    public function work()
    {
    }
}

$developer = new Developer();
$nullDev = new NullWorker();

$objectManager = new ObjectManager($developer);
$objectManager->goWork(); // developer is working

$objectManager2 = new ObjectManager($nullDev);
$objectManager2->goWork(); // null (no nullable error on func call)