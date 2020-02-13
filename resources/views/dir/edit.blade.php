@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование папки</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cell.show', $dir->cell_id ) }}"> Назад</a>
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
    <form action="{{ route('dir.update',$dir->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название папки :</strong>
                    <input type="text" name="title" value="{{ $dir->title }}" class="form-control" placeholder="Name">
{{--                    <input id="arch_cell_link" type="hidden" name="arch_cell_link" value="{{ $dir->arch_cell_link }}" class="form-control" placeholder="arch_cell_link">--}}
                    <select class="form-control" name="cell_id">
                        @foreach($cells as $cell)
                            @foreach($dir->getParent($cell->arch_id) as $id => $title)
                                {{ $my_title = $title }}
                            @endforeach
                            <option value="{{ $cell->id }}" {{ $cell->id == $dir->cell_id ? 'selected' : '' }}>  {{ $my_title . ' - '. $cell->title }}</option>
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
