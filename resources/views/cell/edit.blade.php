@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование ячейки</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('arch.show', $cell->arch_id ) }}"> Назад</a>
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
    <form action="{{ route('cell.update',$cell->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название ячейки:</strong>
                    <input type="text" name="title" value="{{ $cell->title }}" class="form-control" placeholder="Name">
                    <select class="form-control" name="arch_id">
                        @foreach($cells as $id => $title)
                            <option value="{{ $id }}" {{ $id == $cell->arch_id ? 'selected' : '' }}>{{ $title }}</option>
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
