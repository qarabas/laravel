@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left ml-3 mb-4">
                <a class="btn btn-success" href="{{ route('arch.create') }}"> Новый файл</a>
            </div>
        </div>
    </div>
    <form action="{{route('search')}}" method="GET" class="form-inline my-2 my-lg-0">
        <input name="title" class="form-control mr-sm-2" type="search" placeholder="Поиск папки" aria-label="Search" value="{{ old('title') }}" required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Искать</button>
    </form>
    <div class="card-deck">
        @if($search->count() > 0)
            @foreach($search as $item)
                <div class="col-md-3">
                    <img class="card-img-top" src="{{ asset('images/folder.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>

                        <form action="{{ route('dir.destroy', $item->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('dir.show', $item->id) }}">&#128269;</a>
                            <a class="btn btn-primary" href="{{ route('dir.edit', $item->id) }}">&#9998;</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">&#128465;</button>
                        </form>
                        <p class="pt-1">Архив - {{ $item->arch_link }}</p>
                        <p class="">Ячейка - {{ $item->cell_link }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container">
                <div class="row">
                    <div class="col align-self-center">
                        По запросу ничего не найдено
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
