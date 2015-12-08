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
    $array = $this->stopWords('http://www.foodsubs.com/Roots.html');

    $crawler->filter('b')->each(function ($node) use ($array) {
        $s = $node->text();
        $s = str_replace('0xa0', ' ', $s);
        $s = trim($s, " \t\n\r\0\x0B\xC2\xA0");
        $s = trim($s);
        $s = str_replace('Synonyms:', '', $s);
        $s = str_replace('Substitutes:', '', $s);
        $s = str_replace('Pronunciation:', '', $s);
        $s = str_replace('Notes:', '', $s);
        $s = str_replace('Equivalents:', '', $s);

        //$s = str_replace('=', '', $s);
        //$s = str_replace(' ', '', $s);
        if (($s == '') || ($s == '=')) {
          return false;
        }
        if (array_search($s, $array)) {
          return false;
        }
        echo '@'.$s.'@<br>';
    });
    foreach ($array as $value) {
      echo $value.'<br>';
    }

  }

  public function testScrape2() {
    $client = new Client();
    $crawler = $client->request('GET', 'http://www.foodsubs.com/Roots.html');

    $crawler->filter('a')->each(function ($node) {
        $s = $node->text();
        $s = str_replace('0xa0', ' ', $s);
        $s = trim($s, " \t\n\r\0\x0B\xC2\xA0");
        $s = str_replace('Synonyms:', '', $s);
        $s = str_replace('Substitutes:', '', $s);
        $s = str_replace('Pronunciation:', '', $s);
        $s = str_replace('Notes:', '', $s);
        $s = str_replace('Equivalents:', '', $s);

        //$s = str_replace('=', '', $s);
        //$s = str_replace(' ', '', $s);

        echo $s."<br>";
    });


  }

  private function stopWords($url) {
    $client = new Client();
    $crawler = $client->request('GET', $url);
    $returnArray = array();

    $returnArray = $crawler->filter('a')->each(function ($node) use ($returnArray) {
      $s = $node->text();
      $s = str_replace('0xa0', ' ', $s);
      $s = trim($s, " \t\n\r\0\x0B\xC2\xA0");
      return $s;
    });

  return $returnArray;
  }

}
