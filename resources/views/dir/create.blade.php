@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Новая папка</h2>
            </div>
{{--            <div class="pull-right">--}}
{{--                <a class="btn btn-primary" href="{{ route('dir.index') }}"> Back</a>--}}
{{--            </div>--}}
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dir.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название папки :</strong>
                    <input type="text" name="title" class="form-control" placeholder="title">
                    <select class="form-control" name="cell_id">
                        @foreach($cells as $cell)
                            <option value="{{ $cell->id }}">{{ $cell->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@endsection
