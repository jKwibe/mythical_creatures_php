<?php
require_once './src/Hobbit.php';

use \PHPUnit\Framework\TestCase;

class HobbitTest extends TestCase
{
    public function test_hobbit_exists():void
    {
        $hobbit = new Hobbit();
        $this->assertInstanceOf(Hobbit::class, $hobbit);
    }
    public function test_should_have_a_name():void
    {
        $hobbit = new Hobbit('Bilbo');
        $this->assertEquals('Bilbo', $hobbit->name);
    }

    public function test_should_have_unadventurous_disposition():void
    {
        $hobbit = new Hobbit('Bilbo');
        $this->assertEquals('homebody', $hobbit->disposition);
    }

    public function test_has_age():void
    {
        $hobbit = new Hobbit('Bilbo');
        $this->assertEquals(0, $hobbit->age);
    }
    public function test_should_gain_one_year_after_every_birthday():void
    {
        $hobbit = new Hobbit('Bilbo');
        $this->assertEquals(0, $hobbit->age);
        $this->timeTravel(3, $hobbit);
        $this->assertEquals(3, $hobbit->age);
    }

    public function test_should_be_considered_a_child_at_32():void
    {
        $hobbit = new Hobbit('Bilbo');
        $this->assertEquals(0, $hobbit->age);
        $this->timeTravel(32, $hobbit);
        $this->assertEquals(32, $hobbit->age);
        $this->assertEquals(false, $hobbit->adult());
    }

    public function test_should_be_considered_a_adult_at_33():void
    {
        $hobbit = new Hobbit('Bilbo');
        $this->assertEquals(0, $hobbit->age);
        $this->timeTravel(33, $hobbit);
        $this->assertEquals(33, $hobbit->age);
        $this->assertEquals(true, $hobbit->adult());
    }

    private function timeTravel($num, $hobbit):void // Helper method to run the number of years passed
    {
        for($i = 0; $i < $num; $i++)
        {
            $hobbit->celebrateBirthday();
        }
    }

    public function test_should_be_short():void
    {
        $hobbit = new Hobbit('Samwise');
        $this->assertEquals(true, $hobbit->isShort);
    }
    public function test_should_be_considered_old_at_age_101():void
    {
        $hobbit = new Hobbit('Samwise');
        $this->timeTravel(100, $hobbit);

        $this->assertEquals(false, $hobbit->isOld());

        $hobbit->celebrateBirthday();
        $this->assertEquals(true, $hobbit->isOld());
    }

    public function test_should_have_ring_if_name_is_frodo():void
    {
        $hobbit1 = new Hobbit('Frodo');
        $hobbit2 = new Hobbit('Samwise');

        $this->assertEquals(true, $hobbit1->hasRing());
        $this->assertEquals(false, $hobbit2->hasRing());
    }
}