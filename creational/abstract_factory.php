<?php

/*
    Абстрактная фабрика — это порождающий паттерн проектирования, 
    который позволяет создавать семейства связанных объектов, не привязываясь
    к конкретным классам создаваемых объектов.

    https://refactoring.guru/ru/design-patterns/abstract-factory
*/

interface AbstractFactory
{
    public static function createDeveloperWorker(): DeveloperWorker;
    public static function createDesignerWorker(): DesignerWorker;
}

class NativeWorkerFactory implements AbstractFactory
{
    public static function createDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

    public static function createDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }
}

class OutsourceWorkerFactory implements AbstractFactory
{
    public static function createDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

    public static function createDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }
}

interface Worker
{
    public function work();
}

interface DeveloperWorker extends Worker
{
    // developer abstraction
}

interface DesignerWorker extends Worker
{
    // designer abstraction
}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        echo "native developer";
    }
}

class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        echo "outsource developer";
    }
}

class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        echo "native designer";
    }
}

class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {
        echo "outsource designer";
    }
}

$nativeDeveloper = NativeWorkerFactory::createDeveloperWorker();
$nativeDeveloper->work(); // native developer

$nativeDesigner = NativeWorkerFactory::createDesignerWorker();
$nativeDesigner->work(); // native designer

$outsourceDeveloper = OutsourceWorkerFactory::createDeveloperWorker();
$outsourceDeveloper->work(); // outsource developer

$outsourceDesigner = OutsourceWorkerFactory::createDesignerWorker();
$outsourceDesigner->work(); // outsource designer