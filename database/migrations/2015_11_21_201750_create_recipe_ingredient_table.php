<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('book_tag', function (Blueprint $table) {

         $table->increments('id');
         $table->timestamps();

         # `book_id` and `tag_id` will be foreign keys, so they have to be unsigned
         #  Note how the field names here correspond to the tables they will connect...
         # `book_id` will reference the `books table` and `tag_id` will reference the `tags` table.
         $table->integer('recipe_id')->unsigned();
         $table->integer('ingredient_id')->unsigned();

         # Make foreign keys
         $table->foreign('recipe_id')->references('id')->on('recipes');
         $table->foreign('ingredient_id')->references('id')->on('ingredients');
       });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipe_ingredient');
    }
}
