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
    <title>Document</title>
    <style>
        .container {
            border-top: 5px solid black;
            transition: .25s;
        }
        .container:hover {
            background-color: #dce8ff;
        }
    </style>
</head>
<body>

<main>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{url('/')}}">Home</a>
                <a class="nav-item nav-link active" href="{{url('post/listar')}}">Posts</a>
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
    <br><br>

    <form method="post" action="{{url('post/listarPorNome')}}">
        @csrf
        <div style="display:flex;justify-content:center;" class="form-group">
            <label style="margin-right: 10px;font-size:1.2em;">Post(s): </label>
            <input type="text" type="text" name="titulo" id="titulo" placeholder="Pesquisar por título">
            <button type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>

    @if($temas)
        <div class="container">
            <h5 class="card-title">Cadastrar novo Post</h5>
            <form method="post" action="{{url('post/cadastrar')}}">
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" type="text" name="titulo" id="titulo">
                </div>
                <div class="form-group">
                    <label for="post">Post</label>
                    <input class="form-control" type="text" id="post" name="texto">
                </div>
                <div class="form-group">
                    <span>Tema:</span>
                    <select name="tema" id="tema">
                        @foreach($temas as $t)
                            <option value="{{$t->id}}">{{$t->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
            </form>
        </div>
        <br><br>
    @endif

    @forelse($posts as $p)
        <div class="container">
            <!-- <a class="link-titulo" href="{{url('post/detalhar')}}/{{$p->id}}"><h2>{{ucfirst(trans($p->titulo))}}</h2></a> -->
            <h2>{{ucfirst(trans($p->titulo))}}</h2>
            @if (!Auth::guest())
                @if (Auth::user()->id == $p->user_id)
                    <form method="post" action="{{url('post/apagar')}}/{{$p->id}}">
                        @method('DELETE')
                        @csrf
                        <!-- <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden> -->
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                    <!-- <a style="float:right;color:red;" href="{{url('post/apagar')}}/{{$p->id}}"><i class="fas fa-trash-alt"></i></a> -->
                @endif
            @endif
            <small>Tema: {{$p->theme()->first()->nome}}</small>
            <br>
            <small>Criado por: {{$p->user()->first()->email}}</small>
            <p>{{$p->post}}</p>
            <form method="post" action="{{url('resposta/cadastrar')}}">
                @csrf
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nova Resposta</span>
                    </div>
                    <input type="text" class="form-control" id="resposta" name="resposta">
                    <input type="text" name="post_id" value="{{$p->id}}" hidden>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Responder</button>
            </form>
            <br>
            <ul class="list-group">
                <span>Respostas: </span>
                @forelse($p->answers as $a)
                    <br>
                    <small>Respondido por: {{$a->user()->get()->first()->email}}</small>
                    <li class="list-group-item">{{$a->answer}}</li>
                @empty
                    <li class="list-group-item font-italic">Ainda não há respostas nesse post</li>
                @endforelse
                <hr class="#f5f5f5 grey lighten-4">
            </ul>
        </div>
    @empty
        <p>Não há posts cadastrados</p>
    @endforelse
</main>
    
</body>
</html>