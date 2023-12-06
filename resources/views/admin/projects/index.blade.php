@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center ">
            <h1>Qui progetti</h1>
            <a class="btn btn-primary " href="{{ route('admin.projects.create')}}"><i class="fa-solid fa-plus"></i></a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Data creazione</th>
                <th scope="col">Tipo</th>
                <th scope="col">Tecnologia</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($projects as $project)
                <tr>
                  <th scope="row">{{ $project->id}}</th>
                  <td>{{ $project->name}}</td>
                  <td>{{ $project->date_creation}}</td>
                  <td>{{ $project->type->name ?? '-'}}</td>
                  <td>
                    @forelse ($project->tecnologies as $tecnology)

                    <span class="badge bg-dark text-white">{{ $tecnology->name}}</span>
                    @empty
                    -
                    @endforelse
                  </td>
                  <td>
                    <a class="btn btn-success" href="{{ route('admin.projects.show', $project->id)}}"><i class="fa-solid fa-eye"></i></a>
                    <a class="btn btn-warning text-white" href="{{route('admin.projects.edit', $project)}}"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form class="d-inline-block"
                        action="{{ route('admin.projects.destroy', $project->id) }}"
                       method="POST"
                       onsubmit="return confirm ('Sei sicuro di voler eliminare questo elemento?')">

                       @csrf
                       @method("DELETE")
                       <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                  </td>

                </tr>
                @endforeach
            </tbody>
          </table>

        <div>
            {{$projects->links()}}
        </div>
    </div>
@endsection
