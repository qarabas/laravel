@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left ml-3 mb-4">
                <a class="btn btn-success" href="{{ route('arch.create') }}"> Новый архив</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-deck">
        @foreach($arches as $arch)
            <div class="col-md-3">
                <img class="card-img-top" src="{{ asset('images/arch.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $arch->title }}</h5>
                    <form action="{{ route('arch.destroy', $arch->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('arch.show', $arch->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('arch.edit', $arch->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
