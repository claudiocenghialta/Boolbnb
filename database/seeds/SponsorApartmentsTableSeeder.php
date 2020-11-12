<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Sponsor;
use App\SponsorApartment;
use Faker\Generator as Faker;
use Carbon\Carbon;

class SponsorApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentCount = count(Apartment::all()->toArray());
        $sponsorCount = count(Sponsor::all()->toArray());

        for ($i=0; $i < $apartmentCount; $i++) {
            $newSponsorApartment = new SponsorApartment;
            $newSponsorApartment->apartment_id = rand(1,$apartmentCount);
            $newSponsorApartment->sponsor_id = rand(1,$sponsorCount);
            $sponsor = Sponsor::find($newSponsorApartment->sponsor_id);
            $sponsorDurata = $sponsor->durata;
            // $newSponsorApartment->data_inizio = $faker->DateTime();

            //date fixed
            $newSponsorApartment->data_inizio = Carbon::now();

            $ora = Carbon::now();

            $fine = $ora->addHours($sponsorDurata);

            $newSponsorApartment->data_fine = $fine;

            $newSponsorApartment->save();


        }
    }
}

// $date=date_create("2013-03-15");
// date_add($date,date_interval_create_from_date_string("40 days"));
// echo date_format($date,"Y-m-d");
