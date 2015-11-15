<?php

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('recipes')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'url' => 'http://smittenkitchen.com/blog/2015/10/baked-potatoes-with-wild-mushroom-ragu/',
      'title' => 'baked potatoes with wild mushroom ragù',
      'tags' => 'potato, olive oil, butter, onion, garlic, mushroom, wine, broth, thyme, goat cheese, chives',
  ]);

  DB::table('recipes')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'url' => 'http://veggiezest.com/2012/06/29/buttermilk-cornmeal-pancakes-with-corn-salsa/',
      'title' => 'Buttermilk, Cornmeal Pancakes with Corn Salsa | veggiezest',
      'tags' => 'cornmeal, water, flour, buttermilk, cheddar cheese, baking powder, jalapeno, salt, oil, corn, bell pepper, onion, lemon, cilantro',
  ]);

  DB::table('recipes')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'url' => 'http://herbivoracious.com/2012/07/thai-basil-eggplant-recipe.html',
      'title' => 'Thai Basil Eggplant - Recipe | Herbivoracious - Vegetarian Recipe Blog - Easy Vegetarian Recipes, Vegetarian Cookbook, Kosher Recipes, Meatless Recipes',
      'tags' => 'oil, ginger, garlic, lemongrass, eggplant, salt, mushroom, onion, chili, basil',

  ]);
    }
}
