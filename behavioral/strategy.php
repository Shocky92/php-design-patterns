<?php

/*
    Стратегия — это поведенческий паттерн проектирования, который определяет 
    семейство схожих алгоритмов и помещает каждый из них в собственный класс, 
    после чего алгоритмы можно взаимозаменять прямо во время исполнения программы.
*/

interface Definer
{
    public function define($arg);
}

class Data
{
    private int|string|bool $arg;

    public function __construct(
        private Definer $definer,
    ) {
    }

    public function setArg($arg): void
    {
        $this->arg = $arg;
    }

    public function execute()
    {
        return $this->definer->define($this->arg);
    }
}

class IntDefiner implements Definer
{
    public function define($arg): string
    {
        return $arg . ' from int strategy';
    }
}

class StringDefiner implements Definer
{
    public function define($arg): string
    {
        return $arg . ' from string strategy';
    }
}

class BoolDefiner implements Definer
{
    public function define($arg): string
    {
        return $arg . ' from bool strategy';
    }
}

$data = new Data(new IntDefiner());
$data->setArg('some arg');

$data->execute(); // some arg from int strategy