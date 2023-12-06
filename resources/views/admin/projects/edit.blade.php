@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{$title}}</h1>

    {{-- errori visuale --}}
    @if($errors->any())
      <div class="alert alert-danger" role="alert" >
          <ul>
              @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
    @endif
    {{-- /errori visuale --}}


    <form action="{{route('admin.projects.update', $project)}}" method="POST">
        @csrf
        @method('PUT')

        {{-- name form --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name) }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        {{-- /name form --}}

        {{-- date_creation form --}}
        <div class="mb-3">
          <label for="date_creation" class="form-label">Data di creazione *</label>
          <input type="date" class="form-control @error('date_creation') is-invalid @enderror" id="date_creation" id="date_creation" name="date_creation" value="{{ old('date_creation', $project->date_creation) }}">
          @error('date_creation')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        {{-- /date_creation form --}}

        {{-- web_site form --}}
        <div class="mb-3">
            <label for="web_site" class="form-label">Url</label>
            <input type="url" class="form-control @error('web_site') is-invalid @enderror" id="web_site" name="web_site" value="{{ old('web_site', $project->web_site) }}">
            @error('web_site')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        {{-- /web_site form --}}

        {{-- type select options --}}
        <div class="mb-3">
            <label for="type_id" class="form-label">Tipo</label>
            <select id="type_id" name="type_id">
                <option value="">Selezionare una tipologia</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id', $project?->type_id) == $type->id? 'selected' : '' }} >{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- /type select options --}}

        {{-- description form --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" id="description" name="description" value="{{ old('description', $project->description) }}"></textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        {{-- /description form --}}

         {{-- checkBox tecnology --}}
         <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            @foreach ($tecnologies as $tecnology)
            <input
                id="tecnology_{{$tecnology->id}}"
                type="checkbox"
                class="btn-check"
                name="tecnologies[]"
                value="{{$tecnology->id}}">
            <label
                for="tecnology_{{$tecnology->id}}"
                class="btn btn-outline-dark">{{$tecnology->name}}</label>
            @endforeach
        </div>
        {{-- /checkBox --}}

        <button type="submit" class="btn btn-secondary ">Invia</button>
        <button type="reset" class="btn btn-danger">Annulla</button>
      </form>
</div>

@endsection
