<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
      'name' => 'vegetables'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'fruits'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'dairy'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'vegetables'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'flavorings'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'liquids'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'grains'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'grain products'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'baked goods'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'legumes and nuts'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'meats'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'fish'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'vegetables'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'vegetarian'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'baking supplies'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'fats and oils'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'accompaniments'
      'parent_id' => 'null',
      ]);

      DB::table('categories')->insert([
      'created_at' => Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
      'name' => 'miscellaneous'
      'parent_id' => 'null',
      ]);

    }
}
