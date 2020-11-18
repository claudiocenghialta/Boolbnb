<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  protected $fillable = [
      'user_id','titolo', 'descrizione','slug', 'numero_stanze','numero_letti','numero_bagni','mq','indirizzo','attivo','numero_visite', 'lat', 'lng'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function messages()
  {
    return $this->hasMany('App\Message');
  }

  public function optionals()
  {
    return $this->belongsToMany('App\Optional');
  }

  public function images()
  {
    return $this->hasMany('App\Image');
  }

  public function SponsorApartments()
  {
    return $this->hasMany('App\SponsorApartment');
  }

  public function visits()
  {
    return $this->hasMany('App\Visit');
  }
}
