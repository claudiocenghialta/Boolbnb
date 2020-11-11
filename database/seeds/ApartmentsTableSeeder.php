<?php

use App\Apartment;
use App\User;
use App\Optional;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      $usersCount = count(User::all()->toArray()) - 1;
      $optionalsCount = count(Optional::all()->toArray()) - 1;
      // Prendo tutti gli optional per collegarsi all appartamento
      $optional = Optional::all();

        for ($i=0; $i < 10; $i++) {
            $newApartment = new Apartment;
            $newApartment->titolo = $faker->sentence(3);
            $newApartment->descrizione = $faker->text(500);
            $newApartment->slug = Str::finish(Str::slug($newApartment->title), rand(1, 1000000));
            $newApartment->numero_stanze = rand(1,10);
            $newApartment->numero_letti = rand(1,10);
            $newApartment->numero_bagni = rand(1,4);
            $newApartment->mq = rand(40,300);
            $newApartment->indirizzo = $faker->address();
            // $newApartment->numero_visite;
            // $newApartment->attivo = true;
            // $newApartment->imma = $faker->imageUrl(640,400);
            $newApartment->user_id = rand(1, $usersCount);

            $newApartment->save();


            // Per popolare tabella ponte
            $newApartment->optionals()->attach(
                  $optional->random(rand(1, $optionalsCount))->pluck('id')->toArray()
              );


        }

    }
}
