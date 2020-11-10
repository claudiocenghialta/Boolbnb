<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
      'messaggio', 'user_id', 'apartment_id'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function apartment()
  {
    return $this->belongsTo('App\Apartment');
  }
}
