<?php

class Sphinx
{
    public $name;
    public $riddles = array();
    public $heroesEaten = 0;

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

    public function attemptAnswer(string $answer): ?string
    {
        foreach ($this->riddles as $index =>$single_riddle)
        {
           if(strcasecmp($answer, $single_riddle["answer"])==0)
           {
               if(count($this->riddles)==1)
               {
                   return 'PSSSSSSS THIS HAS NEVER HAPPENED, HOW DID YOU KNOW THE ANSWER WAS \"'.$single_riddle["answer"].'\"???';
               }

               var_dump('YAYAYA =>'.$index);
               unset($this->riddles[$index]);
               $this->riddles = array_values($this->riddles);
               return 'That wasn\'t that hard, I bet you don\'t get the next one';
           }
           $this->heroesEaten ++;
           return null;
        }
    }
}
