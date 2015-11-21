<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectCategoriesAndCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('categories', function (Blueprint $table) {
          $table->integer('parent_id')->unsigned();
          $table->foreign('parent_id')->references('id')->on('categories');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $table->dropForeign('ingredients_parent_id_foreign');
          $table->dropColumn('parent_id');
    }
}
