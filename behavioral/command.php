<?php

/*
    Команда — это поведенческий паттерн проектирования, который превращает запросы 
    в объекты, позволяя передавать их как аргументы при вызове методов, ставить 
    запросы в очередь, логировать их, а также поддерживать отмену операций.
*/

interface Command
{
    public function execute();
}

interface Undoable extends Command
{
    public function undo();
}

class Output
{
    private bool $isEnable;
    private string $body = '';

    public function enable()
    {
        $this->isEnable = true;
    }

    public function disable()
    {
        $this->isEnable = false;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function write(string $string)
    {
        if ($this->isEnable) {
            $this->body = $string;
        }
    }
}

class Invoker
{
    private Command $command;

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }

    public function run(): void
    {
        $this->command->execute();
    }
}

class Message implements Command
{
    public function __construct(
        private Output $output
    ) {
    }


    public function execute(): void
    {
        $this->output->write("some string from execute");
    }
}

class StatusChanger implements Undoable
{
    public function __construct(
        private Output $output
    ) {
    }

    public function execute(): void
    {
        $this->output->enable();
    }

    public function undo(): void
    {
        $this->output->disable();
    }
}

$output = new Output();

$invoker = new Invoker();
$invoker->setCommand(new StatusChanger($output));
$invoker->run(); // enable

$invoker->setCommand(new Message($output));
$invoker->run(); // some string from execute