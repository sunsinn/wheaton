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
      'name' => 'potatoesTest',
      'parallel_name' => 'spudsTest',
      'category' => 'TubersTest',

      ]);

      DB::table('ingredients')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'cornTest',
      'parallel_name' => 'maizeTest',
      'category' => 'GrainsTest',

      ]);

      DB::table('ingredients')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'eggplantsTest',
      'parallel_name' => 'auberginesTest',
      'category' => 'Fruit VegetablesTest',

      ]);

      DB::table('ingredients')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'Jerusalem artichokesTest',
      'parallel_name' => 'sunchokesTest',
      'category' => 'TubersTest',

      ]);

    }
}
