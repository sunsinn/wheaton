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

       $recipe->save();
        \Session::flash('flash_message','Recipe updated!');
        return redirect('/books/edit/'.$request->id);

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

     public function postSearch () {
       return view ('search');
     }

     public function browseRec () {
        $recipes = \App\Recipe::all();
        return view ('show')->with('recipes', $recipes);
     }

     public function browseIng () {
        $ingredients = \App\Ingredient::all();
        return view ('show')->with('ingredients', $ingredients);
     }
}
