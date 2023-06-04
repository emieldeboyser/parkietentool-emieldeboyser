<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Type extends Model
{
  // ring relation
  public function rings()
  {
    return $this->hasMany(Ring::class);
  }
    
}
