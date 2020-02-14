@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-12 m-0 p-0">
                <div class="col-lg-2 pull-left pl-0 mb-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                        Новая ячейка
                    </button>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input id="cell_title" type="title" placeholder="Название ячейки">
                                    <div type="submit" class="btn btn-success" onclick="createCell(<?php echo $arch->id; ?>)" data-dismiss="modal">Создать</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row col-lg-12">
                        <div class="col-lg-3">
                            <p class="pt-2">Сортировать по:</p>
                        </div>
                        <div class="col-lg-8 links pr-0 pt-2 pull-left">

                            @php($order_by = 'DESC')
                            @php($arrow = '8593')
                            @if (!empty($order_by_field) && $order_by_field['orderBy'])
                                @if($order_by_field['orderBy'] == 'DESC')
                                    @php($order_by = 'ASC')
                                    @php($arrow = '8595')
                                @endif
                            @endif
                            <div class="col-lg-4 pr-1 pl-0 ml-0 pull-left">
                                <a href="{{ route('arch.show', ['arch' => $arch->id]) }}?order=id&by={{ $order_by }}&page={{ 1 }}&limit={{ $order_by_field['limit'] }}"><i><?php echo $order_by_field['field'] ? $order_by_field['field'] == 'id' ? '&#'.$arrow.';' : ' ' : ' '; ?></i> Идентификатору</a>
                            </div>
                            <div class="col-lg-3 pl-1">
                                <a href="{{ route('arch.show', ['arch' => $arch->id]) }}?order=title&by={{ $order_by }}&page={{ 1 }}&limit={{ $order_by_field['limit'] }}"><i><?php echo $order_by_field['field'] ? $order_by_field['field'] == 'title' ? '&#'.$arrow.';' : ' ' : ' '; ?></i> Названию</a>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{ route('arch.show', ['arch' => $arch->id]) }}?order=created_at&by={{ $order_by }}&page={{ 1 }}&limit={{ $order_by_field['limit'] }}"><i><?php echo $order_by_field['field'] ? $order_by_field['field'] == 'created_at' ? '&#'.$arrow.';' : ' ' : ' '; ?></i> Дате создания</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 pull-right ml-3 mb-4 pr-0">
                    <a class="btn btn-primary pull-right" href="{{ route('arch.index') }}"> Назад</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-lg-5 col-md-4 ml-3 mb-4">
                <strong>Архив :</strong>
                {{ $arch->title }}
            </div>
            <div class="dropdown pull-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Кол-во элементов на странице
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ '?page='.$order_by_field['page'].'&limit=8' }}">8</a>
                    <a class="dropdown-item" href="{{ '?page='.$order_by_field['page'].'&limit=16' }}">16</a>
                    <a class="dropdown-item" href="{{ '?page='.$order_by_field['page'].'&limit=24' }}">24</a>
                </div>
            </div>
        </div>
    </div>
    @if(count($children) > 0)
        <div class="card-deck">
            @foreach($children as $id => $title)
                <div class="col-md-3">
                    <img class="card-img-top" src="{{ asset('images/cell.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title }}</h5>
                        <form action="{{ route('cell.destroy',$id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('cell.show', $id).'?page=1'.'' }}">&#128269;</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">&#128465;</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <nav>
            <ul class="pagination">
                @if((int)$order_by_field['page'] !== 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $order_by_field['prev_page'] }}" rel="prev">« Предыдущая страница</a>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $order_by_field['next_page'] }}" rel="next">Следующая страница »</a>
                </li>
            </ul>
        </nav>
        @else
        <div>
            <h1>Пусто</h1>
        </div>
    @endif
@endsection
