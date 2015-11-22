<?php
use Goutte\Client;

$client = new Client();
$crawler = $client->request('GET', 'http://www.foodsubs.com/Roots.html');

$crawler->filter('b')->each(function ($node) {
    print $node->text()."\n";
});

 ?>
