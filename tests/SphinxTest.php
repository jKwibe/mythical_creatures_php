<?php
use PHPUnit\Framework\TestCase;
require_once './src/Sphinx.php';

class SphinxTest extends TestCase
{
    public function test_sphinx_exists() :void
    {
        $sphinx = new Sphinx();

        $this->assertInstanceOf(Sphinx::class, $sphinx);
        $this->assertEquals(null, $sphinx->name);
    }

    public function test_it_starts_with_no_riddles()
    {
        $sphinx = new Sphinx();

        $this->assertEquals(array(), $sphinx->riddles);
    }

    public function test_collect_riddles()
    {
        $sphinx = new Sphinx();

        $riddle = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $sphinx->collectRiddle($riddle);
        $this->assertEquals(array($riddle), $sphinx->riddles);
    }

    public function test_should_collect_only_three_riddles()
    {
        $sphinx = new Sphinx();

        $riddle1 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $riddle2 = array(
            'riddle' => 'How far can a fox run into a grove?',
            'answer'=> 'short'
        );

        $riddle3 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );
        $riddle4 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $sphinx->collectRiddle($riddle1);
        $sphinx->collectRiddle($riddle2);
        $sphinx->collectRiddle($riddle3);
        $sphinx->collectRiddle($riddle4);

        $this->assertEquals([$riddle2, $riddle3, $riddle4], $sphinx->riddles);
        $this->assertCount(3, $sphinx->riddles);

    }

    public function test_remove_riddle_after_correct_answer()
    {
        $sphinx = new Sphinx();

        $riddle1 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $riddle2 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'me'
        );

        $sphinx->collectRiddle($riddle1);
        $sphinx->collectRiddle($riddle2);
        $sphinx->attemptAnswer('short');

        $this->assertEquals(array($riddle2), $sphinx->riddles);
    }
}
//    it('should accept a correct answer and remove riddle from list', function() {
//        var sphinx = new Sphinx();
//        var riddle1 = {
//            riddle: 'What word becomes shorter when you add two letters to it?',
//      answer: 'short'
//    };
//
//    sphinx.collectRiddle(riddle1);
//    sphinx.attemptAnswer('short');
//
//    assert.deepEqual(sphinx.riddles, []);
//  });
//
//    it('should accept answers in any order', function() {
//        var sphinx = new Sphinx();
//        var riddle1 = {
//            riddle: 'What word becomes shorter when you add two letters to it?',
//      answer: 'short'
//    };
//    var riddle2 = {
//            riddle: 'How far can a fox run into a grove?',
//      answer: 'Halfway, after that it\'s running out.'
//    };
//    var riddle3 = {
//            riddle: 'What starts with an \'e\' and ends with an \'e\' and contains one letter?',
//      answer: 'An envelope'
//    };
//
//    sphinx.collectRiddle(riddle1);
//    sphinx.collectRiddle(riddle2);
//    sphinx.collectRiddle(riddle3);
//    sphinx.attemptAnswer('An envelope');
//
//    assert.deepEqual(sphinx.riddles, [riddle1, riddle2]);
//  });
//
//    it('should mock heroes when they get the answer right', function() {
//        var sphinx = new Sphinx();
//        var riddle1 = {
//            riddle: 'What word becomes shorter when you add two letters to it?',
//      answer: 'short'
//    };
//    var riddle2 = {
//            riddle: 'How far can a fox run into a grove?',
//      answer: 'Halfway, after that it\'s running out.'
//    };
//
//    sphinx.collectRiddle(riddle1);
//    sphinx.collectRiddle(riddle2);
//    var response = sphinx.attemptAnswer('short');
//
//    assert.equal(response, 'That wasn\'t that hard, I bet you don\'t get the next one');
//  });
//
//    it('should start having eaten no heroes', () => {
//        var sphinx = new Sphinx();
//
//        assert.equal(sphinx.heroesEaten, 0);
//    });
//
//  it('should eat the hero if their answer isn\'t correct for any riddles', function() {
//      var sphinx = new Sphinx();
//      var riddle1 = {
//          riddle: 'What word becomes shorter when you add two letters to it?',
//      answer: 'short'
//    };
//    var riddle2 = {
//          riddle: 'How far can a fox run into a grove?',
//      answer: 'Halfway, after that it\'s running out.'
//    };
//    var riddle3 = {
//          riddle: 'What starts with an \'e\' and ends with an \'e\' and contains one letter?',
//      answer: 'An envelope'
//    };
//
//    sphinx.collectRiddle(riddle1);
//    sphinx.collectRiddle(riddle2);
//    sphinx.collectRiddle(riddle3);
//    sphinx.attemptAnswer('e');
//
//    assert.deepEqual(sphinx.riddles, [riddle1, riddle2, riddle3]);
//    assert.equal(sphinx.heroesEaten, 1);
//  });
//
//  it('should scream with rage if a hero gets all riddles correct', function() {
//      var sphinx = new Sphinx();
//      var riddle1 = {
//          riddle: 'What word becomes shorter when you add two letters to it?',
//      answer: 'short'
//    };
//    var riddle2 = {
//          riddle: 'How far can a fox run into a grove?',
//      answer: 'Halfway, after that it\'s running out.'
//    };
//
//    sphinx.collectRiddle(riddle1);
//    sphinx.collectRiddle(riddle2);
//    sphinx.attemptAnswer('short');
//    var rage = sphinx.attemptAnswer('Halfway, after that it\'s running out.');
//
//    assert.equal(rage, 'PSSSSSSS THIS HAS NEVER HAPPENED, HOW DID YOU KNOW THE ANSWER WAS \"Halfway, after that it\'s running out.\"???');
//  });
//
//  it('should scream specifically about the last riddle to be answered', function() {
//      var sphinx = new Sphinx();
//      var riddle1 = {
//          riddle: 'What word becomes shorter when you add two letters to it?',
//      answer: 'short'
//    };
//    var riddle2 = {
//          riddle: 'How far can a fox run into a grove?',
//      answer: 'Halfway, after that it\'s running out.'
//    };
//
//    sphinx.collectRiddle(riddle1);
//    sphinx.collectRiddle(riddle2);
//    sphinx.attemptAnswer('Halfway, after that it\'s running out.');
//    var rage = sphinx.attemptAnswer('short');
//
//    assert.equal(rage, 'PSSSSSSS THIS HAS NEVER HAPPENED, HOW DID YOU KNOW THE ANSWER WAS \"short\"???');
//  });
//});