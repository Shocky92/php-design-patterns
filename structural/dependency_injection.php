<?php

/*
    Внедрение зависимости — процесс предоставления внешней зависимости программному 
    компоненту. Является специфичной формой «инверсии управления» 
    (англ. Inversion of control, IoC), когда она применяется к управлению зависимостями. 
    В полном соответствии с принципом единственной ответственности объект отдаёт заботу
    о построении требуемых ему зависимостей внешнему, специально предназначенному для 
    этого общему механизму. 
*/

class ControllerConfiguration
{
    public function __construct(
        private string $name,
        private string $action,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }
}

class Controller
{
    public function __construct(
        private ControllerConfiguration $configuration,
    ) {
    }

    public function getConfiguration(): string
    {
        return $this->configuration->getName() . '@' . $this->configuration->getAction();
    }
}

$configuration = new ControllerConfiguration('Test', 'index');

$controller = new Controller($configuration);
$controller->getConfiguration(); // Test@index