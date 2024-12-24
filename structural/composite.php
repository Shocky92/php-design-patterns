<?php

/*
    Компоновщик — это структурный паттерн проектирования, который позволяет 
    сгруппировать множество объектов в древовидную структуру, а затем работать с ней так, 
    как будто это единичный объект.
*/

interface Renderable
{
    public function render(): string;
}

class Mail implements Renderable
{
    private array $parts = [];

    public function render(): string
    {
        $result = "";
        foreach ($this->parts as $part) {
            $result .= $part->render();
        }

        return $result;
    }

    public function addPart(Renderable $part): void
    {
        $this->parts[] = $part;
    }
}

abstract class Part
{
    public function __construct(
        private string $text
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}

class Header extends Part implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Body extends Part implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Footer extends Part implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}


$mail = new Mail();
$mail->addPart(new Header("header"));
$mail->addPart(new Body("body"));
$mail->addPart(new Footer("footer"));

$mail->render() . PHP_EOL; // headerbodyfooter