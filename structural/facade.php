<?php

/*
    Фасад — это структурный паттерн проектирования, который предоставляет 
    простой интерфейс к сложной системе классов, библиотеке или фреймворку.
*/

class WorkerFacade
{
    public function __construct(
        private Developer $developer,
        private Designer $designer,
    ) {
    }

    public function startWork()
    {
        $this->developer->startDevelop();
        $this->designer->startDesign();
    }

    public function stopWork()
    {
        $this->developer->stopDevelop();
        $this->designer->stopDesign();
    }
}

class Developer
{
    public function startDevelop()
    {
        echo "develop";
    }

    public function stopDevelop()
    {
        echo "stop develop";
    }
}

class Designer
{
    public function startDesign()
    {
        echo "design";
    }

    public function stopDesign()
    {
        echo "stop design";
    }
}

$developer = new Developer();
$designer = new Designer();

$workerFacade = new WorkerFacade($developer, $designer);

$workerFacade->startWork(); // developdesign
$workerFacade->stopWork(); //stop developstop design