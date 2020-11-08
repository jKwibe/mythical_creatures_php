<?php

use \PHPUnit\Framework\TestCase;
include_once './src/Witch.php';

class WitchTest extends TestCase
{
    public function test_it_exist():void
    {
        $witch = new Witch();
        $this->assertInstanceOf(Witch::class, $witch);
    }

    public function test_it_has_name():void
    {
        $witch = new Witch('Helga');
        $this->assertEquals('Helga', $witch->name);
    }

    public function test_it_should_start_with_an_empty_pantry() :void
    {
        $witch = new Witch('Helga');
        $this->assertEquals([], $witch->pantry);
    }
    public function test_it_can_collect_ingredients() :void
    {
        $witch = new Witch();
        $witch->collect('frog eyes', 10);

        $pantry = ['frog eyes' => 10];
        $this->assertEquals($pantry, $witch->pantry);
    }

    public function test_able_to_add_existing_stock() :void
    {
        $witch = new Witch();
        $witch->collect('frog eyes', 10);
        $witch->collect('frog eyes', 5);

        $pantry = ['frog eyes' => 15];
        $this->assertEquals($pantry, $witch->pantry);

    }

    public function test_able_to_collect_multiple_ingredients():void
    {
        $witch = new Witch();
        $witch->collect('frog eyes', 10);
        $witch->collect('lizard tongues', 5);

        $pantry = [
            'frog eyes' => 10,
            'lizard tongues' => 5,
        ];

        $this->assertEquals($pantry, $witch->pantry);
    }

    public function test_starts_with_no_recipes()
    {
        $witch = new Witch('Helga');
        $this->assertEquals([], $witch->recipes);
    }

    public function test_recipe_exist()
    {
        $recipe = new Recipe('Shrinking Potion');
        $this->assertInstanceOf(Recipe::class, $recipe);
    }

    public  function test_witch_has_recipes()
    {
        $witch = new Witch('Helga');
        $ingredients = array('swap water'=>5, 'frog eyes'=>10, 'dragon scales'=>6);
        $recipe1 = new Recipe('Shrinking Potion', $ingredients);
        $recipe2 = new Recipe('Plain Water', ['water'=>1]);

        $this->assertEquals('Learned: Shrinking Potion', $witch->learnRecipe($recipe1));
        $this->assertEquals([$recipe1], $witch->recipes);

        $this->assertEquals('Learned: Plain Water', $witch->learnRecipe($recipe2));
        $this->assertEquals([$recipe1, $recipe2], $witch->recipes);
    }

    public function test_should_not_learn_the_same_recipe()
    {
        $witch = new Witch('Helga');
        $recipe = new Recipe('Plain Water', ['water'=>1]);

        $witch->learnRecipe($recipe);
        $this->assertEquals('Already Know: Plain Water', $witch->learnRecipe($recipe));

    }

    public function test_should_be_able_to_make_potions_if_has_ingredients()
    {
        $witch = new Witch('Helga');
        $ingredients = array('swamp water'=> 5, 'frog eyes'=> 10, 'dragon scales'=> 6);

        $recipe = new Recipe('Shrinking Potion', $ingredients);

        $witch->learnRecipe($recipe);
        $witch->collect('swamp water', 20);
        $witch->collect('frog eyes', 20);
        $witch->collect('dragon scales', 20);

        $this->assertEquals(array(), $witch->potions);
        $this->assertEquals('Brewed 1 Shrinking Potion', $witch->brewPotion($recipe));
        $this->assertEquals(['Shrinking Potion' => 1], $witch->potions);

        $witch->brewPotion($recipe);
        $this->assertEquals(['Shrinking Potion' => 2], $witch->potions);
    }

    public function test_cannot_brew_the_potion_if_recipe_unknown()
    {
        $witch = new Witch('Helga');
        $recipe = new Recipe('Love Potion');
        $this->assertEquals("Don't know recipe: Love Potion", $witch->brewPotion($recipe));
    }

    public function test_brewing_a_potion_reduces_pantry_stock()
    {
        $witch = new Witch('Helga');
        $ingredients = array( 'swamp water'=> 5, 'frog eyes'=> 10, 'dragon scales'=> 6 );
        $recipe = new Recipe('Shrinking Potion', $ingredients);

        $witch->learnRecipe($recipe);
        $witch->collect('swamp water', 20);
        $witch->collect('frog eyes', 20);
        $witch->collect('dragon scales', 20);

        $witch->brewPotion($recipe);

        $this->assertEquals(15, $witch->pantry['swamp water']);
        $this->assertEquals(10, $witch->pantry['frog eyes']);
        $this->assertEquals(14, $witch->pantry['dragon scales']);
    }

    public function test_cannot_brew_without_sufficient_ingredientsd()
    {
        $witch = new Witch('Helga');
        $ingredients = array( 'swamp water'=> 5, 'frog eyes'=> 10, 'dragon scales'=> 6 );
        $recipe = new Recipe('Shrinking Potion', $ingredients);

        $witch->learnRecipe($recipe);

        $witch->collect('swamp water', 20);
        $witch->collect('frog eyes', 5);
        $message = "Not enough ingredients. Need 5 frog eyes";

        $this->assertEquals($message, $witch->brewPotion($recipe));
    }
}