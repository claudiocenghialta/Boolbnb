<?php

use App\Apartment;
use App\Image;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //aggiunto provider  Picsum.photos "https://github.com/morawskim/faker-images" peché zaninotto non si aggiorna!!!!!
         $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
         $apartmentCount = count(Apartment::all()->toArray());



         for ($i=0; $i < 20 ; $i++) {
            $newImage = new Image;
            //usiamo picsumUrl per utilizzare il nuovo provider
            $newImage->immagine = $faker->picsumUrl(640,480);
            $newImage->apartment_id = rand(1, $apartmentCount);


            $newImage->save();
         }
    }
}
