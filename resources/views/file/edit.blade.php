@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование файла</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dir.show', $file->dir_id ) }}"> Назад</a>
            </div>
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
    <form action="{{ route('file.update',$file->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название файла:</strong>
                    <input type="text" name="title" value="{{ $file->title }}" class="form-control" placeholder="Name">
                    <select class="form-control" name="dir_id">
                        @foreach($dirs as $id => $title)
                            <option value="{{ $id }}" {{ $id == $file->arch_id ? 'selected' : '' }}>{{ $title }}</option>
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
