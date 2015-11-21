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
      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'potatoTest'
      'parallel_names' => 'spudTest',
      'parent_id' => 1,
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'cornTest'
      'parallel_names' => 'sweetTest cornTest, maizeTest',
      'parent_id' => 2,
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'eggplantTest'
      'parallel_names' => 'aubergineTest',
      'parent_id' > 3,
      ]);

    }
}
