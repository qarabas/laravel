@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left ml-3 mb-4">
                <a class="btn btn-success" href="{{ route('arch.create') }}"> Новый файл</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-deck">
        @if($search->count() > 0)
            @foreach($search as $item)
                <div class="col-md-3">
                    <img class="card-img-top" src="{{ asset('images/folder.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>

                        <form action="{{ route('dir.destroy', $item->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('dir.show', $item->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('dir.edit', $item->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
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
