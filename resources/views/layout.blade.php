<!DOCTYPE html>
<html>
<head>
    <title>Laravel 6.0 CRUD Generator Application</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('arch.index') }}">Архивы <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cell.index') }}">Все ячейки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dir.index') }}">Все папки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('file.index') }}">Все файлы</a>
            </li>
        </ul>
        <form action="{{route('search')}}" method="GET" class="form-inline my-2 my-lg-0">
            <input name="title" class="form-control mr-sm-2" type="search" placeholder="Поиск папки" aria-label="Search" value="{{ old('title') }}" required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Искать</button>
        </form>
    </div>
</nav>
<div class="container pt-5">
    @yield('content')
</div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
