<?php

/*
    «Спецификация» в программировании  — это шаблон проектирования, посредством 
    которого представление правил бизнес-логики может быть преобразовано в виде 
    цепочки объектов, связанных операциями булевой логики. 
*/

interface Specification
{
    public function isSatisfiedBy(Pupil $pupil): bool;
}

class Pupil
{
    public function __construct(
        private int $rate = 0,
    ) {
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }
}

class PupilSpecification implements Specification
{
    public function __construct(
        private int $needRate
    ) {
    }

    public function isSatisfiedBy(Pupil $pupil): bool
    {
        return $this->needRate < $pupil->getRate();
    }
}

class AndSpecification implements Specification
{
    public array $specifications;

    public function __construct(
        Specification ...$specification,
    ) {
        $this->specifications = $specification;
    }

    public function isSatisfiedBy(Pupil $pupil): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($pupil)) {
                return false;
            }
        }

        return true;
    }
}

class OrSpecification implements Specification
{
    public array $specifications;

    public function __construct(
        Specification ...$specification,
    ) {
        $this->specifications = $specification;
    }

    public function isSatisfiedBy(Pupil $pupil): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($pupil)) {
                return true;
            }
        }

        return false;
    }
}

class NotSpecification implements Specification
{
    public function __construct(
        private Specification $specification
    ) {
    }

    public function isSatisfiedBy(Pupil $pupil): bool
    {
        return !$this->specification->isSatisfiedBy($pupil);
    }
}

$specification = new PupilSpecification(5);
$specification2 = new PupilSpecification(10);

$pupil = new Pupil(8);

$specification->isSatisfiedBy($pupil); // true
$specification2->isSatisfiedBy($pupil); // false

$andSpecification = new AndSpecification(
    $specification,
    $specification2
);
$andSpecification->isSatisfiedBy($pupil); // false

$orSpecification = new OrSpecification(
    $specification,
    $specification2
);
$orSpecification->isSatisfiedBy($pupil); // true