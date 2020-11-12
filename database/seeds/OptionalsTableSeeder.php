<?php

use Illuminate\Database\Seeder;
use App\Optional;

class OptionalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   // array per poter aggiungere optional
        $optional = [
          'Wifi',
          'Piscina',
          'Posto Macchina',
          'Portineria',
          'Sauna',
          'Vista Mare'
        ];

        for ($i=0; $i < count($optional); $i++) {
            $newOptional = new Optional;
            $newOptional->nome = $optional[$i];
            $newOptional->save();
          }
    }
}
