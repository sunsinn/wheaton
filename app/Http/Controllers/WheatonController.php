<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class WheatonController extends Controller {

  public function __construct() {
    # Put anything here that should happen before any of the other actions
  }

  public function getIndex() {
    return view('index');
  }

  public function getAdd() {
    return view('add');
  }

  public function postAdd(Request $request) {
    $this->validate(
      $request,
      [
        'url' => 'required|url',
        'ingredients' => 'required',
      ]
    );

    $recipe = new \App\Recipe();

    $recipe->url = $request->url;
    $recipe->title = $request->title;

    $recipe->save();

    $ingredients = explode(',', $request->ingredients);
    foreach ($ingredients as $ingredient) {
      $ingToSave = \App\Ingredient::where('name','LIKE','%'.$ingredient.'%')->first();

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
        $recipe->ingredients()->save($newIng);
      }

    }

    \Session::flash('flash_message','Recipe added!');
    return redirect('/add');
}

public function getEdit($id = null) {
  $recipe = \App\Recipe::find($id);
  if(is_null($recipe)) {
    \Session::flash('flash_message','Recipe not found.');
    return redirect('/search');
  }

  $ingredients = $recipe->ingredients()->get();
  $ingString = '';
  foreach ($ingredients as $ingredient) {
    $ingString .= $ingredient->name.', ';
  }
  $ingString = chop($ingString, ', ');
  return view('edit')->with(['recipe'=>$recipe, 'ingredients'=>$ingString]);
}

public function postEdit(Request $request) {

  $this->validate(
    $request,
    [
      'url' => 'required|url',
      'ingredients' => 'required',
    ]
  );

  $recipe = \App\Recipe::find($request->id);

  $recipe->url = $request->url;
  $recipe->title = $request->title;

  ## removes pivot table entry for old ingredients and resets
  $recipe->ingredients()->detach($request->id);

  $ingredients = explode(',', $request->ingredients);
  foreach ($ingredients as $ingredient) {
    $ingToSave = \App\Ingredient::where('name','LIKE','%'.$ingredient.'%')->first();

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
      $recipe->ingredients()->save($newIng);
    }
  }

  $recipe->save();
  \Session::flash('flash_message','Recipe updated!');
  return redirect('/edit/'.$request->id);
}

public function delete (Request $request) {
  $recipe = \App\Recipe::find($request->id);
  $recipe->delete();

  \Session::flash('flash_message','Recipe deleted!');
  return redirect('/');
}

public function getSearch () {
  return view ('search');
}

public function postSearch(Request $request) {

  $recipes = new \App\Recipe();

  if (!empty($request->title)) {
    $recipes = \App\Recipe::where('title','LIKE','%'.$request->title.'%')->get();
    return view ('search')->with('recipes', $recipes);
  }
  elseif (!empty($request->ingredient)) {
    $ingredient = \App\Ingredient::where('name', 'LIKE', '%'.$request->ingredient.'%')->first();

    ## if ingreident isn't found, search under other names
    if (empty($ingredient)) {
      $ingredient = \App\Ingredient::where('parallel_name', 'LIKE', '%'.$request->ingredient.'%')->first();
    }

    if (empty($ingredient)) {
      \Session::flash('flash_message','Ingredient not found');
      return view ('search');
    }

    $recipes =  $ingredient->recipes()->get();

    ## try broader category if no recipes are found
    if (empty($recipes)) {
      $category = $ingredient->category;
      $ingredient = \App\Ingredient::where('category', 'LIKE', '%'.$category.'%')->get();
      $recipes =  $ingredient->recipes()->get();
      if (!empty($recipes)) {
        \Session::flash('flash_message','No recipes found with this ingredient - try using it in one of these');
        return view ('search')->with('recipes', $recipes);
      }
      else {
        \Session::flash('flash_message','No recipes found with this ingredient');
        return view ('search');
      }

    }
    return view ('search')->with('recipes', $recipes);
  }
  else {
    \Session::flash('flash_message','Please enter a title or ingredient');
  }
  return view ('search');

}

public function browseRecipes () {
  $recipes = \App\Recipe::all();
  return view ('show')->with('recipes', $recipes);
}

public function browseIngredients () {
  $ingredients = \App\Ingredient::all();
  return view ('show')->with('ingredients', $ingredients);
}

public function show ($id = null) {
  $recipe = \App\Recipe::find($id);
  $ingredients = $recipe->ingredients()->get();
  $ingString = '';
  foreach ($ingredients as $ingredient) {
    $ingString .= $ingredient->name.', ';
  }
  $ingString = chop($ingString, ', ');
  return view ('show')->with(['singleRecipe'=>$recipe, 'ingredientString'=>$ingString]);

}
}
