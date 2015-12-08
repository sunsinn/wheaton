<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;

class IngredientsController extends Controller {


  public function __construct() {
      # Put anything here that should happen before any of the other actions

  }

  public function populate() {
    set_time_limit(300);
    $client = new Client();

    $array = $this->ingredientsArray();

    foreach ($array as $key => $value) {

      $crawler = $client->request('GET', $value);
      $synonyms = $this->synonymsArray($value);

      $crawler->filter('b')->each(function ($node) use ($key, $synonyms) {

        $s = $node->text();

        // Replaces &nbsp with a space
        $s = str_replace('0xa0', ' ', $s);

        // Removes extraneous words
        $s =str_replace('Synonyms:', '', $s);
        $s = str_replace('Substitutes:', '', $s);
        $s = str_replace('Pronunciation:', '', $s);
        $s = str_replace('Pronuncation:', '', $s);
        $s = str_replace('Notes:', '', $s);
        $s = str_replace('Equivalents:', '', $s);
        $s = str_replace('Varieties:', '', $s);
        $s = str_replace('Latin name:', '', $s);
        $s = str_replace('Latin', '', $s);
        $s = str_replace('Warning:', '', $s);
        $s = str_replace('Plural:', '', $s);
        $s = str_replace('Cooking hints:', '', $s);
        $s = str_replace('Links', '', $s);
        $s = str_replace('Tips', '', $s);
        $s = str_replace('To make your own:', '', $s);
        $s = str_replace('Includes:', '', $s);
        $s = str_replace('Cuts:', '', $s);
        $s = str_replace(':', '', $s);

        $s = trim($s, " \t\n\r\0\x0B\xC2\xA0");

        if (($s == '') || ($s == '=') || ($s == '.') || ($s == ',') || ($s == '+')) {
          return false;
        }

        if (array_search($s, $synonyms)) {
          return false;
        }

        if (!strpbrk($s, '=') && !empty($s) &&  !strpbrk($s, 'See')) {
          $ingredient = new \App\Ingredient();
          $ingredient->category = $key;
          $ingredient->name = $s;
          $ingredient->save();
        }
        elseif (strpbrk($s, '=' )) {
          $ingredient = new \App\Ingredient();
          $ingredient->category = $key;
          $synonyms = explode('=', $s);
          if ($synonyms[0] == '') {
            return false;
          }
          $name = $synonyms[0];
          $parallel_name = '';
          foreach ($synonyms as $synonym) {
            if (($synonym != $name) && ($synonym != '')) {
              $parallel_name .= $synonym;
            }
          }
          $ingredient->name = $name;
          $ingredient->parallel_name = $parallel_name;
          $ingredient->save();
        }

      });

    }
    echo 'Finished!';
  }

  private function synonymsArray($url) {
    $client = new Client();
    $crawler = $client->request('GET', $url);
    $synArray = array();

    $synArray = $crawler->filter('a')->each(function ($node) use ($synArray) {
      $s = $node->text();
      $s = str_replace('0xa0', ' ', $s);
      $s = trim($s, " \t\n\r\0\x0B\xC2\xA0");
      return $s;
    });

  return $synArray;
  }

  private function ingredientsArray() {
    $returnArray = array(
      "Roots" => "http://www.foodsubs.com/Roots.html",
      "Tubers" => "http://www.foodsubs.com/Tubers.html",
      "Potatoes" => "http://www.foodsubs.com/Potatoes.html",
      "Yams" => "http://www.foodsubs.com/Sweetpotatoes.html",
      "Stalk Vegetables" => "http://www.foodsubs.com/Stalk.html",
      "Green Onions" => "http://www.foodsubs.com/Onionsgreen.html",
      "Dry Onions" => "http://www.foodsubs.com/Onionsdry.html",
      "Garlic" => "http://www.foodsubs.com/Garlic.html",
      "Ginger" => "http://www.foodsubs.com/Ginger.html",
      "Cabbages" => "http://www.foodsubs.com/Cabbage.html",
      "Salad Greens" => "http://www.foodsubs.com/Greensld.html",
      "Cooking Greens" => "http://www.foodsubs.com/Greenckg.html",
      "Inflorescents" => "http://www.foodsubs.com/Vegiesinflor.html",
      "Snap Beans" => "http://www.foodsubs.com/Snapbean.html",
      "Edible Pods" => "http://www.foodsubs.com/Pods.html",
      "Fresh Peas" => "http://www.foodsubs.com/Shellpeas.html",
      "Fresh Beans" => "http://www.foodsubs.com/Shellbeans.html",
      "Mushrooms" => "http://www.foodsubs.com/Mushroom.html",
      "Asian Squash" => "http://www.foodsubs.com/Squashasian.html",
      "Avocados" => "http://www.foodsubs.com/Avocados.html",
      "Dried Chile Peppers" => "http://www.foodsubs.com/Chiledry.html",
      "Fresh Chile Peppers" => "http://www.foodsubs.com/Chilefre.html",
      "Cucumbers" => "http://www.foodsubs.com/Squcuke.html",
      "Eggplants" => "http://www.foodsubs.com/Eggplants.html",
      "Olives" => "http://www.foodsubs.com/Olivpick.html",
      "Summer Squash" => "http://www.foodsubs.com/Squashsum.html",
      "Sweet Peppers" => "http://www.foodsubs.com/Peppersw.html",
      "Tomatoes" => "http://www.foodsubs.com/Tomtom.html",
      "Winter Squash" => "http://www.foodsubs.com/Squash.html",
      "Fruit Vegetables" => "http://www.foodsubs.com/Fruitvegies.html",
      "Sea Vegetables" => "http://www.foodsubs.com/Seaveg.html",
      "Sprouts" => "http://www.foodsubs.com/Sprouts.html",
      "Other Vegetables" => "http://www.foodsubs.com/Vegies.html",
      "Citrus Fruit" => "http://www.foodsubs.com/Fruitcit.html",
      "Berries" => "http://www.foodsubs.com/Fruitber.html",
      "Stone Fruit" => "http://www.foodsubs.com/Fruitsto.html",
      "Common Tropical Fruit" => "http://www.foodsubs.com/Fruittro.html",
      "Exotic Tropical Fruit" => "http://www.foodsubs.com/Fruittroex.html",
      "Melons" => "http://www.foodsubs.com/Fruitmel.html",
      "Dried Fruit" => "http://www.foodsubs.com/Fruitdry.html",
      "Pome Fruit" => "http://www.foodsubs.com/Fruitoth.html",
      "Apples" => "http://www.foodsubs.com/Apples.html",
      "Pears"=> "http://www.foodsubs.com/Pears.html",
      "Preserves" => "http://www.foodsubs.com/Fruitpre.html",
      "Candied Foods" => "http://www.foodsubs.com/Candied.html",
      "Juices" => "http://www.foodsubs.com/Juice.html",
      "Milk" => "http://www.foodsubs.com/Dairyoth.html",
      "Cultured Milk" => "http://www.foodsubs.com/Cultmilk.html",
      "Nondairy Milk" => "http://www.foodsubs.com/Nondairy.html",
      "Cheeses" => "http://www.foodsubs.com/Cheese.html",
      "Fresh Cheeses" => "http://www.foodsubs.com/Chefresh.html",
      "Soft Cheeses" => "http://www.foodsubs.com/Chesoft.html",
      "Semi-soft Cheeses" => "http://www.foodsubs.com/Chessoft.html",
      "Semi-firm Cheeses" => "http://www.foodsubs.com/Chesfirm.html",
      "Firm Cheeses" => "http://www.foodsubs.com/Chefirm.html",
      "Blue Cheeses" => "http://www.foodsubs.com/Cheblue.html",
      "Processed Cheeses" => "http://www.foodsubs.com/Cheprocessed.html",
      "Cheese Substitutes" => "http://www.foodsubs.com/CheeseAlt.html",
      "Eggs" => "http://www.foodsubs.com/Eggs.html",
      "Global Herbs" => "http://www.foodsubs.com/HerbsUniv.html",
      "African Herbs" => "http://www.foodsubs.com/HerbsAfrican.html",
      "American Herbs" => "http://www.foodsubs.com/HerbsAmerican.html",
      "Asian Herbs" => "http://www.foodsubs.com/HerbsAsian.html",
      "European Herbs" => "http://www.foodsubs.com/HerbsEur.html",
      "Hispanic Herbs" => "http://www.foodsubs.com/HerbsHisp.html",
      "Indian Herbs" => "http://www.foodsubs.com/HerbsIndian.html",
      "Middle Eastern Herbs" => "http://www.foodsubs.com/HerbsMiddleEast.html",
      "Global Spices" => "http://www.foodsubs.com/SpiceUniv.html",
      "Pepper" => "http://www.foodsubs.com/SpicePepper.html",
      "African Spices" => "http://www.foodsubs.com/SpiceAfr.html",
      "Asian Spices" => "http://www.foodsubs.com/SpiceAsian.html",
      "European Spices" => "http://www.foodsubs.com/SpiceEur.html",
      "Hispanic Spices" => "http://www.foodsubs.com/SpiceHisp.html",
      "Indian Spices" => "http://www.foodsubs.com/SpiceInd.html",
      "Middle Eastern Spices" => "http://www.foodsubs.com/SpiceME.html",
      "African Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixAfr.html",
      "American Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixAmer.html",
      "Asian Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixAsian.html",
      "European Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixEur.html",
      "Hispanic Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixHisp.html",
      "Indian Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixInd.html",
      "Middle Eastern Herb/Spice Mixes" => "http://www.foodsubs.com/SpicemixME.html",
      "Seeds" => "http://www.foodsubs.com/Seeds.html",
      "Extracts" => "http://www.foodsubs.com/Extracts.html",
      "Salt" => "http://www.foodsubs.com/Salt.html",
      "Sugars" => "http://www.foodsubs.com/Sweeten.html",
      "Syrups" => "http://www.foodsubs.com/Syrups.html",
      "Chocolate" => "http://www.foodsubs.com/Chocvan.html",
      "Candy" => "http://www.foodsubs.com/Candy.html",
      "Nut Pastes" => "http://www.foodsubs.com/Nutseed.html",
      "Vinegars" => "http://www.foodsubs.com/Vinegars.html",
      "Liqueurs" => "http://www.foodsubs.com/Liqueurs.html",
      "Aperitifs" => "http://www.foodsubs.com/Aperitif.html",
      "Brandies" => "http://www.foodsubs.com/Brandy.html",
      "Wines" => "http://www.foodsubs.com/Wines.html",
      "Liquors" => "http://www.foodsubs.com/Liquor.html",
      "Beers" => "http://www.foodsubs.com/Beer.html",
      "Bitters" => "http://www.foodsubs.com/Bitters.html",
      "African Condiments" => "http://www.foodsubs.com/CondimntAf.html",
      "American Condiments" => "http://www.foodsubs.com/CondimntAmerican.html",
      "Asian Condiments" => "http://www.foodsubs.com/CondimntAsia.html",
      "European Condiments" => "http://www.foodsubs.com/CondimntEur.html",
      "Hispanic Condiments" => "http://www.foodsubs.com/CondimntHisp.html",
      "Indian Condiments" => "http://www.foodsubs.com/CondimntInd.html",
      "Middle Eastern Condiments" => "http://www.foodsubs.com/CondimntME.html",
      "Stocks Broths Gravies" => "http://www.foodsubs.com/Stock.html",
      "Waters Sodas" => "http://www.foodsubs.com/Waters.html",
      "Rice" => "http://www.foodsubs.com/Rice.html",
      "Wheat" => "http://www.foodsubs.com/GrainWheat.html",
      "Corn" => "http://www.foodsubs.com/GrainCorn.html",
      "Oats" => "http://www.foodsubs.com/GrainOats.html",
      "Barley" => "http://www.foodsubs.com/GrainBarley.html",
      "Buckwheat" => "http://www.foodsubs.com/GrainBuckwheat.html",
      "Rye" => "http://www.foodsubs.com/GrainRye.html",
      "Kamut" => "http://www.foodsubs.com/GrainKamut.html",
      "Triticale" => "http://www.foodsubs.com/GrainTrit.html",
      "Spelt" => "http://www.foodsubs.com/GrainSpelt.html",
      "Other Grains" => "http://www.foodsubs.com/Grainoth.html",
      "Wheat Flours" => "http://www.foodsubs.com/Flour.html",
      "Non-Wheat Flours" => "http://www.foodsubs.com/Flournw.html",
      "Nut Flours" => "http://www.foodsubs.com/Nutmeals.html",
      "Pasta" => "http://www.foodsubs.com/Pasta.html",
      "Pasta Rods" => "http://www.foodsubs.com/PastaRods.html",
      "Pasta Ribbons" => "http://www.foodsubs.com/PastaRibbons.html",
      "Pasta Shapes" => "http://www.foodsubs.com/PastaShapes.html",
      "Soup Pasta" => "http://www.foodsubs.com/PastaSoup.html",
      "Pasta Tubes" => "http://www.foodsubs.com/PastaTubes.html",
      "Stuffed Pasta" => "http://www.foodsubs.com/PastaStuffed.html",
      "Asian Wheat Noodles" => "http://www.foodsubs.com/NoodlesWheat.html",
      "Asian Rice Noodles" => "http://www.foodsubs.com/NoodlesRice.html",
      "Other Asian Noodles" => "http://www.foodsubs.com/NoodlesAsianOther.html",
      "Other Noodles" => "http://www.foodsubs.com/NoodlesOther.html",
      "Dough" => "http://www.foodsubs.com/Dough.html",
      "Thickeners" => "http://www.foodsubs.com/Thicken.html",
      "Gelatins" => "http://www.foodsubs.com/ThickenGelatins.html",
      "Starch Thickeners" => "http://www.foodsubs.com/ThickenStarch.html",
      "Food Wrappers" => "http://www.foodsubs.com/Wrappers.html",
      "Breads" => "http://www.foodsubs.com/Bread.html",
      "Cookies" => "http://www.foodsubs.com/Cookies.html",
      "Cakes" => "http://www.foodsubs.com/Cakes.html",
      "Crackers" => "http://www.foodsubs.com/Crackers.html",
      "Crumbs" => "http://www.foodsubs.com/Crumbs.html",
      "Flatbreads" => "http://www.foodsubs.com/Flatbread.html",
      "Lentils" => "http://www.foodsubs.com/Lentils.html",
      "Dried Beans" => "http://www.foodsubs.com/Beans.html",
      "Nuts" => "http://www.foodsubs.com/Nuts.html",
      "Soy Products" => "http://www.foodsubs.com/Soyprod.html",
      "Bean Products" => "http://www.foodsubs.com/BeanProducts.html",
      "Poultry" => "http://www.foodsubs.com/Poultry.html",
      "Beef" => "http://www.foodsubs.com/Meats.html",
      "Pork" => "http://www.foodsubs.com/MeatPork.html",
      "Lamb" => "http://www.foodsubs.com/MeatLamb.html",
      "Veal" => "http://www.foodsubs.com/MeatVeal.html",
      "Other Meats" => "http://www.foodsubs.com/MeatOther.html",
      "Game" => "http://www.foodsubs.com/Game.html",
      "Bacon" => "http://www.foodsubs.com/MeatcureBacon.html",
      "Sausages" => "http://www.foodsubs.com/MeatcureSausage.html",
      "Cold Cuts" => "http://www.foodsubs.com/MeatcureCC.html",
      "Ham" => "http://www.foodsubs.com/MeatcureHams.html",
      "Variety Meats" => "http://www.foodsubs.com/Meatvar.html",
      "Dried Meats" => "http://www.foodsubs.com/MeatDried.html",
      "Lean Firm-textured Fish" => "http://www.foodsubs.com/Ffirmlea.html",
      "Fatty Firm-textured Fish" => "http://www.foodsubs.com/Ffirmfat.html",
      "Lean Flaky-textured Fish" => "http://www.foodsubs.com/Fflaklea.html",
      "Fatty Flaky-textured Fish" => "http://www.foodsubs.com/Fflakfat.html",
      "Smoked and Dried Fish" => "http://www.foodsubs.com/Fishsmok.html",
      "Shellfish" => "http://www.foodsubs.com/Shelfish.html",
      "Crab" => "http://www.foodsubs.com/Shelfishcrab.html",
      "Caviar" => "http://www.foodsubs.com/Caviar.html",
      "Leavens" => "http://www.foodsubs.com/Leaven.html",
      "Yeast" => "http://www.foodsubs.com/LeavenYeast.html",
      "Fats" => "http://www.foodsubs.com/Fatsoils.html",
      "Oils" => "http://www.foodsubs.com/Oils.html",
      "Edible Flowers" => "http://www.foodsubs.com/Flowers.html",
      "Miscellaneous Baking" => "http://www.foodsubs.com/Misc.html",
      "Pickles" => "http://www.foodsubs.com/Pickles.html",
    );

    return $returnArray;
  }

}
