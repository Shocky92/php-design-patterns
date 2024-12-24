<?php

/*
    Мост — это структурный паттерн проектирования, который разделяет один или 
    несколько классов на две отдельные иерархии — абстракцию и реализацию, 
    позволяя изменять их независимо друг от друга.
*/

interface Formatter
{
    public function format(string $value);
}

class SimpleText implements Formatter
{
    public function format(string $value): string
    {
        return $value;
    }
}

class HtmlText implements Formatter
{
    public function format(string $value): string
    {
        return "<p>$value</p>";
    }
}

abstract class BridgeService
{
    public function __construct(
        public Formatter $formatter,
    ) {
    }

    abstract public function getFormatter($string): string;
}

class SimpleTextService extends BridgeService
{
    public function getFormatter($string): string
    {
        return $this->formatter->format($string);
    }
}

class HtmlTextService extends BridgeService
{
    public function getFormatter($string): string
    {
        return $this->formatter->format($string);
    }
}

$simpleText = new SimpleText();
$htmlText = new HtmlText();

$simpleTextService = new SimpleTextService($simpleText);
$htmlTextService = new HtmlTextService($htmlText);

$simpleTextService->getFormatter('Hello'); // Hello
$htmlTextService->getFormatter('Hello'); // <p>Hello</p>