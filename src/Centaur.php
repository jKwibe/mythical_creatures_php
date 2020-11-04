<?php
class Centaur
{
    private $name;
    private $breed;
    private $cranky;
    private $count;
    private $isStanding;
    private $isLaying;

    public function __construct($name, $breed='Palomino')
    {
        $this->name = $name;
        $this->breed = $breed;
        $this->cranky = false;
        $this->count = 0;
        $this->isStanding = true;
        $this->isLaying = false;
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
        if ($this->isCranky() || $this->isLaying){
            return 'No!!!';
        }
        $this->count ++;
        return 'Thwang!!!';
    }

    public function run()
    {
        if($this->isLaying)
        {
            return 'No!!!';
        }
        $this->count ++;
        return 'Clop clop clop!!!';
    }
    public function isCranky()
    {
        return $this->count >= 3 && !($this->isLaying);
    }

    public function isSleeping()
    {
        if($this->isStanding)
        {
            return 'Still Standing';
        }
        return 'No!!';
    }

    public function sleep()
    {
        if($this->isLaying)
        {
            $this->count = 0;
            return 'ZZZZ';
        }
        return 'Not a sleep';
    }

    public function isStanding()
    {
        return $this->isStanding;
    }
    public function isLaying()
    {
        return $this->isLaying;
    }

    public function layDown()
    {
        $this->isStanding = false;
        $this->isLaying = true;
    }

    public function standUp()
    {
        $this->isStanding = true;
        $this->isLaying = false;
    }

}
