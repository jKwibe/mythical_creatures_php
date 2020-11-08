<?php
class Witch
{

    public $name;
    public $pantry = array();
    public $recipes = array();
    public $potions = array();

    public function __construct(string $name=null)
    {
        $this->name = $name;
    }

    public function collect(string $item , int $quantity):void
    {
        if(array_key_exists($item, $this->pantry))
        {
            $this->pantry[$item] += $quantity;
        }
        else
        {
            $this->pantry[$item] = $quantity;
        }
    }

    /**
     * @param Recipe $recipe
     * @return string|null
     */
    public function learnRecipe(Recipe $recipe): ?string
    {
        if(in_array($recipe, $this->recipes))
        {
            return "Already Know: ". $recipe->name;
        }
        array_push($this->recipes, $recipe);
        return "Learned: ".$recipe->name;
    }

    /**
     * @param Recipe $recipe
     * @return string|null
     */
    public function brewPotion(Recipe $recipe): ?string
    {
        if (empty($recipe->ingredients))
        {
            return "Don't know recipe: ".$recipe->name;
        }

        if(array_key_exists($recipe->name,$this->potions))
        {
            $this->potions[$recipe->name]+=1;
        }else
        {
            $this->potions[$recipe->name]=1;
        }

         foreach ($recipe->ingredients as $ingredient_name => $amount)
         {
             if($amount > $this->pantry[$ingredient_name] ||$ingredient_name==null )
             {
               return 'Not enough ingredients. Need '. ($amount-$this->pantry[$ingredient_name]). ' '.$ingredient_name;
             }
             $this->pantry[$ingredient_name] -= $amount;
         }

        return "Brewed 1 ".$recipe->name;
    }
}

/**
 *
 * RECIPE
 *
 */

class Recipe
{
    public $name;
    public $ingredients = array();

    public function __construct(string $name, array $ingredients=null)
    {
        $this->name = $name;
        $this->ingredients = $ingredients;
    }
}