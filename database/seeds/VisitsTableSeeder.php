<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Visit;
use Carbon\Carbon;
use Faker\Generator as Faker;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentCount = count(Apartment::all()->toArray());

        for ($i=0; $i < 100; $i++) {
            $newVisit = new Visit;
            $newVisit->apartment_id = rand(1,$apartmentCount);
            $newVisit->data_visita = $faker->dateTimeBetween('-200 days','-1 days');

            $newVisit->save();
        }

    }
}
// $min = strtotime($start_date);
//     $max = strtotime($end_date);
//
//     // Generate random number using above bounds
//     $val = rand($min, $max);
//
//     // Convert back to desired date format
//     return date('Y-m-d H:i:s', $val);
