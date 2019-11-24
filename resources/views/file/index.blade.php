@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left ml-3 mb-4">
                <a class="btn btn-success" href="{{ route('file.create') }}"> Новый файл</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
        @foreach ($files as $file)
            <div class="col-md-3">
                <img class="card-img-top" src="{{ asset('images/file.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $file->title }}</h5>
                    <form action="{{ route('file.destroy', $file->id) }}" method="POST">
{{--                        <a class="btn btn-info" href="{{ route('file.show', $file->id) }}">Show</a>--}}
{{--                        <a class="btn btn-primary" href="{{ route('file.edit', $file->id) }}">Edit</a>--}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
@endsection
