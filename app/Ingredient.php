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
      $ingToSave = \App\Ingredient::where('name','LIKE','%'.$ingredient.'%')->get();
      

      ## Checks cross references if ingredient name isn't found
      if (!isset($ingToSave)) {
        $ingToSave = \App\Ingredient::where('parallel_name', 'LIKE', '%'.$ingredient.'%')->first();
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
