<?php

/*
    Паттерн Интерпретатор (Interpreter) определяет представление грамматики для 
    заданного языка и интерпретатор предложений этого языка. Как правило, 
    данный шаблон проектирования применяется для часто повторяющихся операций.
*/

abstract class Expression
{
    abstract public function interpret(Context $context): bool;
}

class Context
{
    private array $worker = [];

    public function setWorker(string $worker): void
    {
        $this->worker[] = $worker;
    }

    public function lookUp($key): string|bool
    {
        if (isset($this->worker[$key])) {
            return $this->worker[$key];
        }

        return false;
    }
}

class VariableExp extends Expression
{
    public function __construct(
        private int $key
    ) {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->key);
    }
}

class AndExp extends Expression
{
    public function __construct(
        private int $keyOne,
        private int $keyTwo,
    ) {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) && $context->lookUp($this->keyTwo);
    }
}

class OrExp extends Expression
{
    public function __construct(
        private int $keyOne,
        private int $keyTwo,
    ) {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) || $context->lookUp($this->keyTwo);
    }
}

$context = new Context();
$context->setWorker('Bob'); // 0
$context->setWorker('Ben'); // 1

$varExp = new VariableExp(1);
$andExp = new AndExp(1, 3);
$orExp = new OrExp(1, 2);

$varExp->interpret($context); // true
$andExp->interpret($context); // false
$orExp->interpret($context); // true