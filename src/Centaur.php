<?php
class Centaur
{
    private $name;
    private $breed;
    private $count = 0;
    private $isStanding = true;
    private $isLaying = false;

    public function __construct($name, $breed='Palomino')
    {
        $this->name = $name;
        $this->breed = $breed;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getBreed():string
    {
        return $this->breed;
    }

    public function shoot():string
    {
        if ($this->isCranky() || $this->isLaying){
            return 'No!!!';
        }
        $this->count ++;
        return 'Thwang!!!';
    }

    public function run():string
    {
        if($this->isLaying)
        {
            return 'No!!!';
        }
        $this->count ++;
        return 'Clop clop clop!!!';
    }
    public function isCranky():bool
    {
        return $this->count >= 3 && $this->isLaying==false;
    }

    public function isSleeping() :string
    {
        if($this->isStanding)
        {
            return 'Still Standing';
        }
        return 'No!!';
    }

    public function sleep():string
    {
        if($this->isLaying)
        {
            $this->count = 0;
            return 'ZZZZ';
        }
        return 'Not a sleep';
    }

    public function isStanding():bool
    {
        return $this->isStanding;
    }
    public function isLaying():bool
    {
        return $this->isLaying;
    }

    public function layDown():void
    {
        $this->isStanding = false;
        $this->isLaying = true;
    }

    public function standUp():void
    {
        $this->isStanding = true;
        $this->isLaying = false;
    }

    public function drinkPotion()
    {
        if($this->isLaying())
        {
            return 'Can\'t drink while standing';
        }

        if($this->count==0)
        {
            $this->count = 3;
            return;
        }

        $this->count = 0;
}

}
