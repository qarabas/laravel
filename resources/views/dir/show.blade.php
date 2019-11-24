@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left ml-3 mb-4">
                <a class="btn btn-success" href="{{ route('file.create') }}"> Новый файл</a>
                <a class="btn btn-primary" href="{{ route('cell.show', $dir->cell_id ) }}"> Назад</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ml-3 mb-4">
                <strong>Название папки:</strong>
                {{ $dir->title }}
            </div>
        </div>
    </div>
    <div class="card-deck">
        @foreach($children as $id => $title)
            <div class="col-md-3">
                <img class="card-img-top" src="{{ asset('images/file.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <form action="{{ route('file.destroy',$id) }}" method="POST">
{{--                        <a class="btn btn-info" href="{{ route('file.show', $id) }}">Show</a>--}}
{{--                        <a class="btn btn-primary" href="{{ route('file.edit', $id) }}">Edit</a>--}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
