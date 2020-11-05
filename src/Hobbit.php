<?php
class Hobbit
{
    public $name;
    public $disposition = 'homebody';
    public $age;
    public $isShort = true;

    public function __construct(string $name=null, int $age=0)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function celebrateBirthday():void
    {
        $this->age += 1;
    }

    public function adult():bool
    {
        return $this->age > 32;
    }

    public function isOld():bool
    {
        return $this->age > 100;
    }
}
