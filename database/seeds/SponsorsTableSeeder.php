<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsor = [
            [
                'costo' => 2.99,
                'durata' => 24,
                'nome' => 'Silver'
            ],
            [
                'costo' => 5.99,
                'durata' => 72,
                'nome' => 'Gold'
            ],
            [
                'costo' => 9.99,
                'durata' => 144,
                'nome' => 'Platinum'
            ]
        ];

        for ($i=0; $i < count($sponsor); $i++) {
            $newSponsor = new Sponsor;
            $newSponsor->nome = $sponsor[$i]['nome'];
            $newSponsor->costo = $sponsor[$i]['costo'];
            $newSponsor->durata = $sponsor[$i]['durata'];
            $newSponsor->save();
          }
    }
}
