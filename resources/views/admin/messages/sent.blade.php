@extends('layouts.app')

@section('content')

<table class="table container mt-3 col-8">
  <thead class="thead-light bg-primary text-light">
    <tr>
      <th scope="col">Appartamento</th>
      <th scope="col">Messaggio</th>
      <th scope="col">E-mail proprietario</th>
      <th scope="col">Inviato il</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($messages as $message)
    <tr>
      <th scope="row">{{$message->apartment->titolo}}</th>
      <td>{{$message->messaggio}}</td>
      <td>{{$message->apartment->user->email}}</td>
      <td>{{$message->updated_at->format('D d/m/Y - H:m')}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
