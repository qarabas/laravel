@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-12 m-0 p-0">
                <div class="col-lg-2 pull-left pl-0 mb-4">
                    <a class="btn btn-success" href="{{ route('file.create').'?dir_id=' . $dir->id }}"> Новый файл</a>
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
                                <a href="{{ route('dir.show', ['dir' => $dir->id]) }}?order=id&by={{ $order_by }}&page={{ 1 }}&limit={{ $order_by_field['limit'] }}"><i><?php echo $order_by_field['field'] ? $order_by_field['field'] == 'id' ? '&#'.$arrow.';' : ' ' : ' '; ?></i> Идентификатору</a>
                            </div>
                            <div class="col-lg-3 pl-1">
                                <a href="{{ route('dir.show', ['dir' => $dir->id]) }}?order=title&by={{ $order_by }}&page={{ 1 }}&limit={{ $order_by_field['limit'] }}"><i><?php echo $order_by_field['field'] ? $order_by_field['field'] == 'title' ? '&#'.$arrow.';' : ' ' : ' '; ?></i> Названию</a>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{ route('dir.show', ['dir' => $dir->id]) }}?order=created_at&by={{ $order_by }}&page={{ 1 }}&limit={{ $order_by_field['limit'] }}"><i><?php echo $order_by_field['field'] ? $order_by_field['field'] == 'created_at' ? '&#'.$arrow.';' : ' ' : ' '; ?></i> Дате создания</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 pull-right ml-3 mb-4 pr-0">
                    <a class="btn btn-primary pull-right" href="{{ route('dir.index') }}"> Назад</a>
                </div>
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
    @if(count($children) > 0)
        <div class="card-deck">
        @foreach($children as $id => $title)
            <div class="col-md-3">
                <img class="card-img-top" src="{{ asset('images/file.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <form action="{{ route('file.destroy',$id) }}" method="POST">
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
                        <a class="page-link" href="{{ $order_by_field['prev_page'].'?page=1' }}" rel="prev">« Предыдущая страница</a>
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
