@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Dettaglio progetto</h1>
        <h3>{{$type->id}} | {{$type->name}}</h3>
        <p>{{$type->description}}</p>
    </div>
@endsection
