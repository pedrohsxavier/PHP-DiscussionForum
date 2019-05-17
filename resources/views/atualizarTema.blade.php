<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" 
        integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{url('/')}}">Home</a>
                <a class="nav-item nav-link" href="{{url('post/listar')}}">Posts</a>
                <a class="nav-item nav-link" href="{{url('tema/listar')}}">Temas</a>
                @if (!Auth::guest())
                    <a class="nav-item nav-link log" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                @else
                    <a class="nav-item nav-link log" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
            </div>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @if($tema)
        <div class="card" style="width: 35%;">
            <div class="card-body">
                <form method="POST" action="{{url('tema/atualizar')}}/{{$tema->id}}">
                    @method('put')
                    @csrf
                    <input type="text" name="id" value="{{$tema->id}}" hidden>
                    <div class="form-group">
                        <input type="text" class="form-control" id="tema" name="nome" value="{{$tema->nome}}" aria-describedby="Tema" placeholder="Digite o nome do tema">
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
    @else
        <p>Não existe um tema com id {{$id}}</p>
    @endif

</body>
</html>