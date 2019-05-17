<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" 
        integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
        .card:nth-child(odd) {
            background-color: #dce8ff;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(3, 30%);
            grid-row-gap: 35px;
        }
    </style>
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
                <a class="nav-item nav-link active" href="{{url('tema/listar')}}">Temas</a>
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
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cadastrar novo tema</h5>
                <form method="POST" action="{{url('tema/cadastrar')}}">
                    @csrf
                    <div class="form-group">
                        <input style="width:200px;" type="text" class="form-control" id="tema" name="nome" aria-describedby="Tema" placeholder="Digite o Tema">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <form method="post" action="{{url('tema/listarPorNome')}}">
        @csrf
        <div style="display:flex;justify-content:center;" class="form-group">
            <label style="margin-right: 10px;font-size:1.2em;">Tema(s): </label>
            <input type="text" type="text" name="nome" placeholder="Pesquisar por nome">
            <button type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <br><br>
    <div class="container">
        @forelse($temas as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                @if (!Auth::guest())
                    @if (Auth::user()->id == $t->user_id)
                        <a style="float:right;" href="{{url('tema/atualizar')}}/{{$t->id}}"><i class="fas fa-pen"></i></a>
                    @endif
                @endif
                <h5 class="card-title">{{$t->nome}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Criado por: {{$t->user['name']}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Adicionado em: {{date('d/m/Y',strtotime($t->created_at))}}</h6>
                <a href="{{url('post/listarPorTema')}}/{{$t->id}}" class="card-link">{{count($t->posts)}} post(s) relacionado(s)</a>
            </div>
        </div>
        @empty
            <p>Não há temas cadastrados</p>
        @endforelse
    </div>

</body>
</html>