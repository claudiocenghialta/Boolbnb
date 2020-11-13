@extends('layouts.app')
{{-- @section('content')
  <ul>
    @foreach ($apartments as $apartment)
      <li>
        <h1>{{$apartment->titolo}}</h1>
      </li>
    @endforeach
  </ul>
@endsection --}}
@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status')}}
    </div>
  @endif
  {{-- INSERIRE CARDS X APPARTAMENTI --}}
  <table class="table mx-auto col-5">
    <thead class="thead-light">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($apartments as $apartment)
      <tr>
        <th scope="row">{{ $apartment->id }}</th>
        <td><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></td>
        <td><a href="{{ route('apartments.edit', $apartment->id )}}">Edit</a></td>
        <td>
          <form action="{{ route('apartments.destroy', $apartment->id )}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" name="button" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
@endsection
