<?php

/*
    Легковес — это структурный паттерн проектирования, который позволяет 
    вместить бóльшее количество объектов в отведённую оперативную память. 
    Легковес экономит память, разделяя общее состояние объектов между собой, 
    вместо хранения одинаковых данных в каждом объекте.
*/

interface Mail
{
    public function render(): string;
}

abstract class TypeMail
{
    public function __construct(
        private string $text,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class BusinessMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from business mail';
    }
}

class JobMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from job mail';
    }
}

class MailFactory
{
    private array $pool = [];

    public function getMail(int $id, string $type): Mail
    {
        if (!isset($this->pool[$id])) {
            $this->pool[$id] = $this->make($type);
        }

        return $this->pool[$id];
    }

    private function make(string $typeMail): Mail
    {
        return match ($typeMail) {
            'business' => new BusinessMail('business text'),
            // 'job' => new JobMail('job text'),
            default => new JobMail('job text'),
        };
    }
}

$mailFactory = new MailFactory();
$mail = $mailFactory->getMail(10, 'business');
$mail->render(); // business text from business mail

$mail2 = $mailFactory->getMail(101, 'kakaka');
$mail2->render(); // job text from job mail