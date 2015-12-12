<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
  public function recipes() {
    return $this->belongsToMany('\App\Recipe')->withTimestamps();;
  }

  function ingredientsFromString ($str, Recipe $recipe) {

    $ingredients = explode(',', $str);
    foreach ($ingredients as $ingredient) {
      $ingToSave = \App\Ingredient::where('name','=', trim($ingredient))->first();

      ## Check singular form if necessary
      if (!isset($ingToSave)) {
        $ingToSave = \App\Ingredient::where('name', '=', trim(str_singular($ingredient)) )->first();
      }


      ## Links ingredient to recipe, or adds new ingredient and links
      if (isset($ingToSave)) {
        $recipe->ingredients()->save($ingToSave);
      }
      else {
        $newIng = new \App\Ingredient();
        $newIng->name = $ingredient;
        $newIng->save();
        $recipe->ingredients()->save($newIng);
      }
    }
  }


}
