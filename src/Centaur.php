<?php
class Centaur
{
    private $name;
    private $breed;

    public function __construct($name, $breed='Palomino')
    {
        $this->name = $name;
        $this->breed = $breed;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBreed()
    {
        return $this->breed;
    }
    
}