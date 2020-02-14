@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left ml-3 mb-4">
                <a class="btn btn-success" href="{{ route('cell.create') }}"> Новая ячейка</a>
            </div>
        </div>
    </div>
        @foreach ($cells as $cell)
            <div class="col-md-3">
                <img class="card-img-top" src="{{ asset('images/cell.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $cell->title }}</h5>
                    <form action="{{ route('cell.destroy', $cell->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('cell.show', $cell->id).'?page=1' }}">&#128269;</a>
{{--                        <a class="btn btn-primary" href="{{ route('cell.edit', $cell->id) }}">Edit</a>--}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">&#128465;</button>
                    </form>
                </div>
            </div>
        @endforeach
@endsection
