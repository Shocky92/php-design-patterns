<?php

/*
    Шаблонный метод — это поведенческий паттерн проектирования, который определяет 
    скелет алгоритма, перекладывая ответственность за некоторые его шаги на подклассы. 
    Паттерн позволяет подклассам переопределять шаги алгоритма, не меняя его общей 
    структуры.
*/

abstract class Task
{
    public function printSections()
    {
        $this->printHeader();
        $this->printBody();
        $this->printFooter();
        $this->printCustom();
    }

    private function printHeader()
    {
        echo "header" . PHP_EOL;
    }

    private function printBody()
    {
        echo "body" . PHP_EOL;
    }

    private function printFooter()
    {
        echo "footer" . PHP_EOL;
    }

    abstract protected function printCustom();
}

class DeveloperTask extends Task
{
    protected function printCustom()
    {
        echo "for developer" . PHP_EOL;
    }
}

class DesignerTask extends Task
{
    protected function printCustom()
    {
        echo "for designer" . PHP_EOL;
    }
}

$developerTask = new DeveloperTask();
$designerTask = new DesignerTask();

$developerTask->printSections(); // header body footer for developer
$designerTask->printSections(); // header body footer for designer