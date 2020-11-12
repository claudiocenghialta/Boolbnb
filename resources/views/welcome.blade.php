@php
$usersCount = count(User::all()->toArray()) - 1;
$apartmentCount = count(Apartment::all()->toArray()) - 1;
$user_id = rand(1, $usersCount);

  $apartment_id = rand(1, $apartmentCount);
$apartment = Apartment::find($apartment_id);

var_dump($user_id ,$apartment)
@endphp
