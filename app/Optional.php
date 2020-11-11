<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Optional extends Model
{
  protected $fillable = [
      'nome'
  ];

  public function apartments()
  {
    return $this->belongsToMany('App\Apartment');
  }
}
