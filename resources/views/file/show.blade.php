@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dir.show', $file->dir_id ) }}"> Назад</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ml-3 mb-4">
                <strong>Название файла :</strong>
                {{ $file->title }}
            </div>
        </div>
    </div>
@endsection
