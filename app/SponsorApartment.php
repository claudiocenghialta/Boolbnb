<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorApartment extends Model
{
  protected $fillable = [
      'sponsor_id', 'apartment_id', 'data_inizio', 'data_fine'
  ];
  //conflitto updated_at/created_at
  public $timestamps = false;

  public function apartment()
  {
    return $this->belongsTo('App\Apartment');
  }

  public function sponsor()
  {
    return $this->belongsTo('App\Sponsor');
  }
}
