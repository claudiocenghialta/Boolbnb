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
      $usersCount = count(User::all()->toArray());
      $optionalsCount = count(Optional::all()->toArray());
      // Prendo tutti gli optional per collegarsi all appartamento
      $optional = Optional::all();

      $indirizzi = [
          [
              'indirizzo'=>'Via Po, Torino, Piemonte, Italia',
              'lat'=>45.0683,
              'lng'=>7.69005,
          ],
          [
              'indirizzo'=>'Via Albiroli, Bologna, Emilia-Romagna, Italia',
              'lat'=>44.4959,
              'lng'=>11.3449,
          ],
          [
              'indirizzo'=>'Via T. A. Edison, Bolzano, Trentino-Alto Adige/Südtirol, Italia',
              'lat'=>46.478,
              'lng'=>11.3449,
          ],
          [
              'indirizzo'=>'Via Antonio Banfi, Imola, Emilia-Romagna, Italia',
              'lat'=>44.3506,
              'lng'=>11.7331,
          ],
          [
              'indirizzo'=>'Via Achille Grandi, Moncalieri, Piemonte, Italia',
              'lat'=>44.9721,
              'lng'=>7.70917,
          ],
          [
              'indirizzo'=>'Via Genova, Ladispoli, Lazio, Italia',
              'lat'=>41.9481,
              'lng'=>12.0836,
          ],
          [
              'indirizzo'=>'Piazzale dello Stadio Olimpico, Roma, Lazio, Italia',
              'lat'=>41.9335,
              'lng'=>12.4525,
          ],
          [
              'indirizzo'=>'Via Tiburtina, Roma, Lazio, Italia',
              'lat'=>41.925,
              'lng'=>12.5728,
          ],
          [
              'indirizzo'=>'Corso Orbassano, Torino, Piemonte, Italia',
              'lat'=>45.0351,
              'lng'=>7.62366,
          ],
          [
              'indirizzo'=>'Corso Aldo Moro, Castenaso, Emilia-Romagna, Italia',
              'lat'=>44.5107,
              'lng'=>11.4591,
          ],
          [
              'indirizzo'=>'Piazza Castello, Torino, Piemonte, Italia',
              'lat'=>45.0706698,
              'lng'=>7.682886,
          ],
          [
              'indirizzo'=>'Via Zanboni, Bologna, Emilia-Romagna, Italia',
              'lat'=>44.4964332,
              'lng'=>11.3489126,
          ],
          [
              'indirizzo'=>'Via Montenapoleone, Milano, Lombardia, Italia',
              'lat'=>45.4689662,
              'lng'=>9.1945799,
          ],
          [
              'indirizzo'=>'Piazza San Babila, Milano, Lombardia, Italia',
              'lat'=>45.46634,
              'lng'=>9.19773,
          ],
          [
              'indirizzo'=>'Via dè Tornabuoni, Firenze, Toscana, Italia',
              'lat'=>43.7708488,
              'lng'=>11.2509275,
          ],
          [
              'indirizzo'=>'Via del Corso, Firenze, Toscana, Italia',
              'lat'=>43.77151,
              'lng'=>11.25581,
          ],
          [
              'indirizzo'=>'Via S. Giacomo dei Capri, Napoli, Campania, Italia',
              'lat'=>40.8554757,
              'lng'=>14.2226433,
          ],
          [
              'indirizzo'=>'Corso Secondigliano, Napoli, Campania, Italia',
              'lat'=>40.8898201,
              'lng'=>14.2618,
          ],
          [
              'indirizzo'=>'Largo Cesare Reduzzi, Roma, Lazio, Italia',
              'lat'=>41.8468893,
              'lng'=>12.4084858,
          ],
          [
              'indirizzo'=>'Via Mortara, Milano, Lombardia, Italia',
              'lat'=>45.4540124,
              'lng'=>9.1722546,
          ]
      ];
        for ($i=0; $i < 20; $i++) {
            $newApartment = new Apartment;
            $newApartment->titolo = $faker->sentence(3);
            $newApartment->descrizione = $faker->text(500);
            $newApartment->numero_stanze = rand(1,10);
            $newApartment->numero_letti = rand(1,10);
            $newApartment->numero_bagni = rand(1,4);
            $newApartment->mq = rand(40,300);
            $newApartment->indirizzo = $indirizzi[$i]['indirizzo'];
            $newApartment->lat = $indirizzi[$i]['lat'];
            $newApartment->lng = $indirizzi[$i]['lng'];
            $newApartment->user_id = rand(1, $usersCount);
            $newApartment->slug = Str::finish(Str::slug($newApartment->titolo), rand(1,10000));


            $newApartment->save();


            // Per popolare tabella ponte
            $newApartment->optionals()->attach(
                  $optional->random(rand(1, $optionalsCount))->pluck('id')->toArray()
              );




        }

    }
}
