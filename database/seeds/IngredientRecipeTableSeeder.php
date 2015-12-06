<?php

use Illuminate\Database\Seeder;

class IngredientRecipeTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $recipes =[
      'baked potatoes with wild mushroom ragù' => ['potatoTest'],
      'Buttermilk, Cornmeal Pancakes with Corn Salsa' => ['cornTest'],
      'Thai Basil Eggplant' => ['eggplantTest']
    ];


    foreach($recipes as $title => $ingredients) {

      $recipe = \App\Recipe::where('title','like',$title)->first();

      foreach($ingredients as $ingredient) {
        $ingredientName = \App\Ingredient::where('name','LIKE',$ingredient)->first();

        $recipe->ingredients()->save($ingredientName);
      }

    }
  }
}
