<?php
class Centaur
{
    private $name;
    private $breed;
    private $cranky;

    public function __construct($name, $breed='Palomino')
    {
        $this->name = $name;
        $this->breed = $breed;
        $this->cranky = false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function shoot()
    {
        return 'Thwang!!!';
    }

    public function run()
    {
        return 'Clop clop clop!!!';
    }
    public function isCranky()
    {
        return $this->cranky;
    }

}