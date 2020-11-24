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

        for ($i=0; $i < 30; $i++) {
            $newSponsorApartment = new SponsorApartment;
            $newSponsorApartment->apartment_id = rand(1,$apartmentCount);
            $newSponsorApartment->sponsor_id = rand(1,$sponsorCount);
            $sponsor = Sponsor::find($newSponsorApartment->sponsor_id);
            $sponsorDurata = $sponsor->durata;
            // $newSponsorApartment->data_inizio = $faker->DateTime();

            //date fixed
            
            $fakerData =  $faker->dateTimeBetween('-200 days','4 days');
            $ultimaDataFine = Carbon::parse(SponsorApartment::where('apartment_id',$newSponsorApartment->apartment_id)->pluck('data_fine')->sortDesc()->first());
            if($ultimaDataFine->greaterThan($fakerData)){
                $newSponsorApartment->data_inizio = $ultimaDataFine;
            } else {
                $newSponsorApartment->data_inizio = $fakerData;
            };
            $newSponsorApartment->data_fine = Carbon::parse($newSponsorApartment->data_inizio)->addHours($sponsorDurata);


            // vecchio metodo
            // $newSponsorApartment->data_inizio = Carbon::now();

            // $fakerData = Carbon::now();

            // $fine = $fakerData->addHours($sponsorDurata);

            // $newSponsorApartment->data_fine = $fine;

            $newSponsorApartment->save();


        }
    }
}

// $date=date_create("2013-03-15");
// date_add($date,date_interval_create_from_date_string("40 days"));
// echo date_format($date,"Y-m-d");
