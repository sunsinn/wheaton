<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ingredients')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'potatoTest',
      'parallel_name' => 'spudTest',
      'category' => 'Roots',

      ]);

      DB::table('ingredients')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'cornTest',
      'parallel_name' => 'maizeTest',
      'category' => 'Grains',

      ]);

      DB::table('ingredients')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'eggplantTest',
      'parallel_name' => 'aubergineTest',
      'category' => 'Fruit VegetablesTest',

      ]);

    }
}
