<?php

class Sphinx
{
    public $name;
    public $riddles = array();

    /**
     * @param array $riddle
     * @return void
     */
    public function collectRiddle(array $riddle): void
    {
        array_push($this->riddles, $riddle);
        if(count($this->riddles) > 3)
        {
            array_shift($this->riddles);
        }
    }

    public function attemptAnswer(string $answer)
    {
        foreach ($this->riddles as $index =>$single_riddle)
        {
           if(strcasecmp($answer, $single_riddle["answer"])==0)
           {
               unset($this->riddles[$index]);
               $this->riddles = array_values($this->riddles);
           }
        }
    }
}
