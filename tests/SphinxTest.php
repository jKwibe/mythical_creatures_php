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

    public function test_should_mock_heroes_when_they_get_correct_answer()
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

        $response = $sphinx->attemptAnswer('short');
        $this->assertEquals('That wasn\'t that hard, I bet you don\'t get the next one', $response);
    }

    public function test_should_start_having_eaten_no_heros()
    {
        $sphinx = new Sphinx();
        $this->assertEquals(0, $sphinx->heroesEaten);
    }

    public function test_should_eat_hero_if_no_answer_is_correct()
    {
        $sphinx = new Sphinx();

        $riddle1 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $riddle2 = array(
          'riddle'=> 'How far can a fox run into a grove?',
          'answer'=> 'Halfway, after that it\'s running out.'
        );

        $riddle3 = array(
            'riddle'=> 'What starts with an \'e\' and ends with an \'e\' and contains one letter?',
            'answer'=> 'An envelope'
        );

        $sphinx->collectRiddle($riddle1);
        $sphinx->collectRiddle($riddle2);
        $sphinx->collectRiddle($riddle3);

        $sphinx->attemptAnswer('wrong answer');

        $this->assertEquals(array($riddle1, $riddle2,$riddle3), $sphinx->riddles);
        $this->assertEquals(1, $sphinx->heroesEaten);
    }

    public function test_scream_with_range_when_hero_gets_all_riddles_correct()
    {
        $sphinx = new Sphinx();

        $riddle1 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $riddle2 = array(
            'riddle'=> 'How far can a fox run into a grove?',
            'answer'=> 'Halfway, after that it\'s running out.'
        );

        $sphinx->collectRiddle($riddle1);
        $sphinx->collectRiddle($riddle2);

        $sphinx->attemptAnswer('short');
        $rage = $sphinx->attemptAnswer('Halfway, after that it\'s running out.');

        $message = 'PSSSSSSS THIS HAS NEVER HAPPENED, HOW DID YOU KNOW THE ANSWER WAS \"Halfway, after that it\'s running out.\"???';
        $this->assertEquals($message,$rage);
    }

    public function test_scream_specifically_on_the_last_riddle()
    {
        $sphinx = new Sphinx();

        $riddle1 = array(
            'riddle' => 'What word becomes shorter when you add two letters to it?',
            'answer'=> 'short'
        );

        $riddle2 = array(
            'riddle'=> 'How far can a fox run into a grove?',
            'answer'=> 'Halfway, after that it\'s running out.'
        );

        $sphinx->collectRiddle($riddle1);
        $sphinx->collectRiddle($riddle2);

        $sphinx->attemptAnswer('Halfway, after that it\'s running out.');

        $rage = $sphinx->attemptAnswer('short');
//        var_dump($sphinx->riddles);

        $message = 'PSSSSSSS THIS HAS NEVER HAPPENED, HOW DID YOU KNOW THE ANSWER WAS \"short\"???';
        $this->assertEquals($message,$rage);
    }

}
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