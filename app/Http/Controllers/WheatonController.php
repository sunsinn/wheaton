<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;


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
               'url' => 'required|min:5',
               'tags' => 'required',
             ]
       );

       $recipe = new \App\Recipe();
       $recipe->url = $request->url;

       $client = new Client();
       $crawler = $client->request('GET', $request->url);
       $crawler->filter('h2 > a')->each(function ($node) {
          $recipe->title = $node->text();
        });

        $recipe->tags = $request->tags;

        $recipe->save();

        \Session::flash('flash_message','Recipe added');
        return redirect('/edit');
  }
}
