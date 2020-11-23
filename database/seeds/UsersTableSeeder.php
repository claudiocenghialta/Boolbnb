<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 3; $i++) {
             $newUser = new User;
             $newUser->nome = $faker->name;
             $newUser->email = $faker->email;
             $newUser->password = Hash::make('esempio');
             $newUser->save();
         }

         $newUser = new User;
             $newUser->nome = 'Cristiano';
             $newUser->cognome = 'Malgioglio';
             $newUser->email = 'malgy@gmail.com';
             $newUser->password = Hash::make('esempio');
             $newUser->save();
    }
}
