<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectCategoriesAndIngredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ingredients', function (Blueprint $table) {
          $table->integer('category_id')->unsigned();
          $table->foreign('category_id')->references('id')->on('categories');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('ingredients', function (Blueprint $table) {
        $table->dropForeign('ingredients_category_id_foreign');
        $table->dropColumn('category_id');

    });
  }
}
