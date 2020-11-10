<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  protected $fillable = [
      'nome', 'costo', 'durata'
  ];

  public function SponsorApartments()
  {
    return $this->hasMany('App\SponsorApartment');
  }
}
