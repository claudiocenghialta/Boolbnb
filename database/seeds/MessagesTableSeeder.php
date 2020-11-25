<?php

use App\Apartment;
use App\User;
use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      $usersCount = count(User::all()->toArray());
      $apartmentCount = count(Apartment::all()->toArray());

        for ($i=0; $i < 30; $i++) {
            $newMessage = new Message;
            $newMessage->messaggio = $faker->sentence(5);
            $newMessage->user_id = rand(1, $usersCount);
            $newMessage->updated_at = $faker->dateTimeBetween('-200 days','-1 days');
            $newMessage->created_at = $newMessage->updated_at;
            //ciclo per user_id diverso da user_id di questo appartamento! user non manda messaggi a se stesso #foreveralone
            do {
              $newMessage->apartment_id = rand(1, $apartmentCount);
              $apartment = Apartment::find($newMessage->apartment_id);
              $user_id = $apartment->user_id;
            }
            while ($newMessage->user_id == $user_id);

            $newMessage->save();
        }

    }
}
