<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'data_visita', 'apartment_id'
    ];
    public $timestamps = false;

    public function apartment()
    {
      return $this->belongsTo('App\Apartment');
    }
}
