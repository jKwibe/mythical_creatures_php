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
 }

//it.skip('should have a breed', function() {
//    var centaur = new Centaur('George', 'Palomino');
//    assert.equal(centaur.breed, 'Palomino');
//});
//
//it.skip('should have excellent bow skills', function() {
//    var centaur = new Centaur('George');
//    assert.equal(centaur.shoot(), 'Twang!!!');
//});
//
//it.skip('should have a horse sound when it runs', function() {
//    var centaur = new Centaur('George');
//    assert.equal(centaur.run(), 'Clop clop clop clop!!!');
//});
//
//it.skip('should not be cranky when first created', function() {
//    var centaur = new Centaur('George');
//    assert.equal(centaur.cranky, false);
//});
//
//it.skip('should be standing up when first created', function() {
//    var centaur = new Centaur('George');
//    assert.equal(centaur.standing, true);
//});
//
//it.skip('should be cranky after running or shooting a bow three times', function() {
//    var centaur = new Centaur('George');
//
//    assert.equal(centaur.cranky, false);
//
//    centaur.shoot()
//    centaur.run()
//    centaur.shoot()
//
//    assert.equal(centaur.cranky, true)
//  });
//
//it.skip('should not shoot when cranky', function() {
//    var centaur = new Centaur('George');
//
//    for (var i = 0; i < 3; i++)  {
//        centaur.shoot();
//    }
//
//    assert.equal(centaur.shoot(), 'NO!');
//  });
//
//it.skip('should not sleep while standing', function() {
//    var centaur = new Centaur('George');
//    assert.equal(centaur.sleep(), 'NO!');
//});
//
//it.skip('after laying down it is not standing', function() {
//    var centaur = new Centaur('George');
//
//    assert.equal(centaur.standing, true);
//    assert.equal(centaur.layingDown, false);
//
//    centaur.layDown();
//
//    assert.equal(centaur.standing, false);
//    assert.equal(centaur.layingDown, true);
//
//    centaur.standUp();
//
//    assert.equal(centaur.standing, true);
//    assert.equal(centaur.layingDown, false);
//});
//
//it.skip('should not run or shoot while laying down', function() {
//    var centaur = new Centaur('George');
//
//    centaur.layDown();
//
//    assert.equal(centaur.shoot(), 'NO!');
//    assert.equal(centaur.run(), 'NO!');
//});
//
//it.skip('should be able to sleep when laying down', function() {
//    var centaur = new Centaur('George');
//    centaur.layDown();
//    assert.equal(centaur.sleep(), 'ZZZZ');
//});
//
//it.skip('should not be cranky after sleeping', function() {
//    var centaur = new Centaur('George');
//
//    for (var i = 0; i < 3; i++)  {
//        centaur.shoot();
//    }
//
//    assert.equal(centaur.cranky, true);
//
//    centaur.layDown();
//
//    assert.equal(centaur.sleep(), 'ZZZZ');
//    assert.equal(centaur.cranky, false);
//
//    centaur.standUp();
//    assert.equal(centaur.shoot(),'Twang!!!');
//  });
//
//it.skip('should not be cranky after drinking potion', function() {
//    var centaur = new Centaur('George');
//
//    for (var i = 0; i < 3; i++)  {
//        centaur.shoot();
//    }
//
//    centaur.drinkPotion();
//
//    assert.equal(centaur.cranky, false)
//  });
//
//it.skip('should only drink potion while standing', function() {
//    var centaur = new Centaur('George');
//
//    centaur.drinkPotion();
//    centaur.layDown();
//
//    assert.equal(centaur.drinkPotion(), 'Not while I\'m laying down!');
//});
//
//it.skip('should be cranky if it drinks potion while rested', function() {
//    var centaur = new Centaur('George');
//
//    assert.equal(centaur.cranky, false);
//
//    centaur.drinkPotion();
//
//    assert.equal(centaur.cranky, true);
//});
//});