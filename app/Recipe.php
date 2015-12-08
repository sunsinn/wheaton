<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
  public function ingredients() {
    return $this->belongsToMany('\App\Ingredient')->withTimestamps();;
  }

  public function user() {
    return $this->belongsTo('\App\User');
  }
}
