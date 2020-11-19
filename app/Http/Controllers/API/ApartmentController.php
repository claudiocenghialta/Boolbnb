<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
    public function index() {

      return response()->json(Apartment::get(),200);
    }

    public function apartments(Apartment $apartment) {

      return response()->json($apartment,200);
    }
}
