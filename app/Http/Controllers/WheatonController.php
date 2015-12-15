<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class WheatonController extends Controller {

  public function __construct() {
    # Put anything here that should happen before any of the other actions
  }

  public function getIndex() {
    $recipes = \App\Recipe::orderBy('id', 'desc')->take(5)->get();
    return view('index')->with('recipes', $recipes);
  }

  public function getAdd() {

    if(!\Auth::check() ) {
      \Session::flash('flash_message','You have to be logged in to add or edit recipes');
      return redirect('/');
    }
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
  $recipe->user_id = \Auth::id();

  $recipe->save();

  $ingSave = new \App\Ingredient();
  $ingSave->ingredientsFromString($request->ingredients, $recipe);

  \Session::flash('flash_message','Recipe added!');
  return redirect('/edit/'.$recipe->id);
}

public function getEdit($id = null) {

  if(!\Auth::check() ) {
    \Session::flash('flash_message','You have to be logged in to add or edit recipes');
    return redirect('/');
  }
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
    'title' => 'required',
    'ingredients' => 'required',
  ]
);

$recipe = \App\Recipe::find($request->id);

$recipe->url = $request->url;
$recipe->title = $request->title;

$recipe->save();

$ingredients = $request->ingredients;
$recipe->ingredients()->detach();
$ingSave = new \App\Ingredient();
$ingSave->ingredientsFromString($ingredients, $recipe);

\Session::flash('flash_message','Recipe updated!');
return redirect('/edit/'.$request->id);
}

public function delete (Request $request) {
  $recipe = \App\Recipe::find($request->id);
  $recipe->ingredients()->detach();
  $recipe->delete();

  \Session::flash('flash_message','Recipe deleted!');
  return redirect('/search');
}

public function getSearch () {
  return view ('search');
}

public function postSearch(Request $request) {

  $recipes = new \App\Recipe();
  if (empty($request->title) && empty($request->ingredient)){
    \Session::flash('flash_message','Please enter a title or ingredient');
    return view ('search');
  }

  elseif (!empty($request->title)) {
    if ($request->mineall ==  'mine') {
      $recipes = \App\Recipe::where('title','LIKE','%'.$request->title.'%')->where('user_id','=',\Auth::id())->get();
    }
    else {
      $recipes = \App\Recipe::where('title','LIKE','%'.$request->title.'%')->get();
    }

    return view ('search')->with('recipes', $recipes);
  }
  else  {

    $ingredient = \App\Ingredient::where('name', '=', $request->ingredient)->first();

    ## if ingredient isn't found, search under other names
    if (empty($ingredient)) {
      $ingredient = \App\Ingredient::where('parallel_name', '=', $request->ingredient)->first();
    }

    if (empty($ingredient)) {
      \Session::flash('flash_message','Ingredient not found');
      return view ('search');
    }

    $emptyTrue = $ingredient->recipes()->get();
    if ($emptyTrue->isEmpty()) {
      $category = $ingredient->category;
      $recipes = \App\Recipe::whereHas('ingredients', function ($f) use ($category) {
        $f->where('category', '=', $category);
      })->get();

      if ($recipes->isEmpty()) {
        \Session::flash('flash_message','No recipes found with this ingredient');
        return view ('search');
      }
      else {
        \Session::flash('flash_message','No recipes found with this ingredient - try using it in one of these');
        return view ('search')->with('recipes', $recipes);
      }

    }



  }


  if ($request->mineall ==  'mine') {
    $recipes =  $ingredient->recipes()->where('user_id','=',\Auth::id())->get();
  }
  else {
    $recipes =  $ingredient->recipes()->get();
  }

  return view ('search')->with('recipes', $recipes);

}

public function browseRecipes () {
  $recipes = \App\Recipe::orderBy('title')->get();
  return view ('show')->with('recipes', $recipes);
}

public function browseMyRecipes () {
  $recipes = \App\Recipe::where('user_id','=',\Auth::id())->orderBy('title')->get();
  return view ('show')->with('recipes', $recipes);
}

public function browseIngredients () {
  $ingredients = \App\Ingredient::has('recipes')->orderBy('name')->get();
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

public function showRecipes ($id = null) {
  $ingredient = \App\Ingredient::find($id);
  $recipes = $ingredient->recipes()->get();
  return view ('show')->with('recipes', $recipes);
}


}
