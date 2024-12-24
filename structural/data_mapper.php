<?php

/*
    Data Mapper — это программная прослойка, разделяющая объект и БД. 
    Его обязанность — пересылать данные между ними и изолировать их друг от друга. 
    При использовании Data Mapper'а объекты не нуждаются в знании о существовании БД.
*/

class Worker
{
    public function __construct(
        private string $name
    ) {
    }

    public static function make(array $args): self
    {
        return new self($args['name']);
    }
}

class WorkerMapper
{
    public function __construct(
        private WorkerStorage $storage
    ) {
    }

    public function findById(string $id): string|Worker
    {
        $res = $this->storage->find($id);
        if ($res === null) {
            return 'Worker not found';
        }

        return $this->make($res);
    }

    private function make(array $args): Worker
    {
        return Worker::make($args);
    }
}

class WorkerStorage
{

    public function __construct(
        private array $data = []
    ) {
    }

    public function find(string $id): ?Worker
    {
        if (array_key_exists($id, $this->data)) {
            return $this->data[$id];
        }

        return null;
    }
}

$workerStorage = new WorkerStorage([
    1 => ['name' => 'Something'],
]);

$workerMapper = new WorkerMapper($workerStorage);

$worker = $workerMapper->findById(1); // name => Something
$worker = $workerMapper->findById(2); // Worker not found
