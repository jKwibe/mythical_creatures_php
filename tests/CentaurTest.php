<?php
use PHPUnit\Framework\TestCase;

 class CentaurTest extends TestCase
 {
     public function test_instance()
     {
         $centaur = new Centaur('CentaurName');

         $this->assertInstanceOf(
             Centaur::class,
             $centaur
         );
     }

     public function test_it_should_have_name()
     {
         $centaur = new Centaur('George');
         $name = $centaur->getName();
         $this->assertEquals('George', $name);

         $centaur2 = new Centaur('Bob');
         $name = $centaur2->getName();
         $this->assertEquals('Bob', $name);
     }

     public function test_it_has_breed()
     {
         $centaur = new Centaur('George');
         $breed = $centaur->getBreed();
         $this->assertEquals('Palomino', $breed);

         $centaur2 = new Centaur('George', 'Groath');
         $breed = $centaur2->getBreed();
         $this->assertEquals('Groath', $breed);
     }

     public function test_has_excellent_bow_skills()
     {
         $centaur = new Centaur('George');

         $shoot = $centaur->shoot();

         $this->assertEquals('Thwang!!!', $shoot);
     }

     public function test_it_should_have_horse_sound_when_running()
     {
         $centaur = new Centaur('George');
         $this->assertEquals('Clop clop clop!!!', $centaur->run());
     }

     public function test_should_not_be_cranky_when_first_created()
     {
         $centaur = new Centaur('George');
         $this->assertEquals(false, $centaur->isCranky());
     }

     public function test_should_be_cranky_after_shooting_bow_three_times()
     {
         $centaur = new Centaur('George');
         $this->assertEquals(false, $centaur->isCranky());

         $centaur->shoot();
         $centaur->run();
         $centaur->shoot();
         $this->assertEquals(true, $centaur->isCranky());
     }

     public function test_should_not_shoot_when_cranky()
     {
         $centaur = new Centaur('George');

         $this->assertEquals(false, $centaur->isCranky());

         $centaur->shoot();
         $centaur->run();
         $centaur->shoot();
         $this->assertEquals('No!!!', $centaur->shoot());
     }

     public function test_should_not_sleep_while_standing()
     {
         $centaur = new Centaur('George');
         $this->assertEquals('Still Standing', $centaur->isSleeping());
         $centaur->layDown();
         $this->assertEquals('No!!', $centaur->isSleeping());
     }

     public function test_not_standing_after_laying_down()
     {
         $centaur = new Centaur('George');

         $this->assertEquals(true, $centaur->isStanding());
         $this->assertEquals(false, $centaur->isLaying());

         $centaur->layDown();

         $this->assertEquals(false, $centaur->isStanding());
         $this->assertEquals(true, $centaur->isLaying());

         $centaur->standUp();

         $this->assertEquals(true, $centaur->isStanding());
         $this->assertEquals(false, $centaur->isLaying());

     }

     public function test_should_not_shoot_and_run_while_laying_down()
     {
         $centaur = new Centaur('George');

         $centaur->layDown();

         $this->assertEquals('No!!!', $centaur->shoot());
         $this->assertEquals('No!!!', $centaur->run());
     }

     public function test_should_sleep_when_laying_down()
     {
         $centaur = new Centaur('George');
         $this->assertEquals('Not a sleep', $centaur->sleep());

         $centaur->layDown();

         $this->assertEquals('ZZZZ', $centaur->sleep());
     }

     public function test_should_not_be_cranky_after_sleeping()
     {
         $centaur = new Centaur('Geaorgr');

         for($i =0; $i < 3; $i++)
         {
             $centaur->shoot();
         }
         $this->assertEquals(true, $centaur->isCranky());

         $centaur->layDown();

         $this->assertEquals(false, $centaur->isCranky());
         $this->assertEquals('ZZZZ', $centaur->sleep());

         $centaur->standUp();
         $this->assertEquals('Thwang!!!', $centaur->shoot());
     }

     public function test_should_not_be_cranky_after_drinking_a_potion()
     {
         $centaur = new Centaur('George');

         for ($i = 0; $i < 3; $i++)
         {
             $centaur->shoot();
         }
         $this->assertEquals(true, $centaur->isCranky());

         $centaur->drinkPotion();

         $this->assertEquals(false, $centaur->isCranky());
     }

     public function test_should_only_drink_potion_while_standing()
     {
         $centaur = new Centaur('George');

         $centaur->drinkPotion();
         $centaur->layDown();

         $this->assertEquals('Can\'t drink while standing', $centaur->drinkPotion());
     }

     public function test_should_be_cranky_if_drink_postion_while_rested()
     {
         $centaur = new Centaur('George');

         $this->assertEquals(false, $centaur->isCranky());
         $centaur->drinkPotion();
         $this->assertEquals(true, $centaur->isCranky());
     }
 }
