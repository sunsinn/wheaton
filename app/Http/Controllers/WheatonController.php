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

       //$recipe->ingredients = $request->ingredients;

       $recipe->save();

        \Session::flash('flash_message','Recipe added');
        return redirect('/add');
   }

   public function getEdit($id = null) {
     $recipe = \App\Recipe::find($id);
        if(is_null($recipe)) {
          \Session::flash('flash_message','Recipe not found.');
        return redirect('/index');
    }
    return view('edit')->with('recipe',$recipe);
     }
}
