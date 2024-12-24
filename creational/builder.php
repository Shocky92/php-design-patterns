<?php

/*
    Строитель — это порождающий паттерн проектирования, который позволяет
    создавать сложные объекты пошагово. Строитель даёт возможность использовать
    один и тот же код строительства для получения разных представлений объектов.

    https://refactoring.guru/ru/design-patterns/builder
*/

class Operator
{
    public function make(Builder $builder): Message
    {
        $builder->makeHeader();
        $builder->makeBody();
        $builder->makeFooter();
        $builder->makeCustom();
        return $builder->getText();
    }
}

interface Builder
{
    public function makeHeader();
    public function makeBody();
    public function makeFooter();
    public function makeCustom();
    public function getText();

}

class TextBuilder implements Builder
{
    private Message $message;

    public function make()
    {
        $this->message = new Message();
    }

    public function makeHeader()
    {
        $this->message->setPart(new Header("header"));
    }

    public function makeBody()
    {
        $this->message->setPart(new Body("body"));
    }

    public function makeFooter()
    {
        $this->message->setPart(new Footer("footer"));
    }

    public function makeCustom()
    {
        $this->message->setPart(new Custom("custom"));
    }

    public function getText(): Message
    {
        return $this->message;
    }
}

class Section
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __tostring(): string
    {
        return $this->text;
    }
}

class Header extends Section
{
}

class Body extends Section
{
}

class Footer extends Section
{
}

class Custom extends Section
{
}

class Message
{
    private string $text = '';

    public function setPart($part)
    {
        $this->text .= $part . PHP_EOL;
    }

    public function getText(): string
    {
        return $this->text;
    }
}

$operator = new Operator();
$builder = new TextBuilder();
$message = $operator->make($builder->make());