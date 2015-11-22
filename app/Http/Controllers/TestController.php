<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;

class TestController extends Controller {

  public function __construct() {
      # Put anything here that should happen before any of the other actions
  }

  public function testScrape() {
    $client = new Client();
    $crawler = $client->request('GET', 'http://www.foodsubs.com/Roots.html');

    $crawler->filter('b')->each(function ($node) {
        $s = $node->text();
        $s =str_replace('Synonyms:', '', $s);
        $s = str_replace('Substitutes:', '', $s);
        $s = str_replace('Pronunciation:', '', $s);
        $s = str_replace('Notes:', '', $s);
        $s = str_replace('Equivalents:', '', $s);
        $s = str_replace('=', '', $s);
        $s = str_replace('  ', ' ', $s);
        print $s."\n";
    });

  }

}
