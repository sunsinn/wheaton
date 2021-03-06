<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {

          $table->increments('id');
          $table->timestamps();


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
        Schema::drop('ingredient_recipe');
    }
}
