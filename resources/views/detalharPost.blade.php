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

    @if ($post)
        <form method="post" action="{{url('post/apagar')}}/{{$post->id}}">
            @method('delete')
            @csrf
            <!-- <input type="text" value="{{$post->id}}" hidden> -->
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input class="form-control" type="text" id="titulo" value="{{ucfirst(trans($post->titulo))}}">
            </div>
            <div class="form-group">
                <label for="post">Post</label>
                <input class="form-control" type="text" id="post" value="{{$post->post}}">
            </div>
            <button class="btn btn-primary btn-sm" type="submit">Apagar</button>
        </form>
        <!-- <small>Tema: {{$post->theme()->first()->theme}}</small> -->
        <!-- <br> -->
        <!-- <small>Criado por: {{$post->user()->first()->email}}</small> -->
        <!-- <p></p> -->
        <!-- @forelse($post->answers as $a) -->
            <!-- <br> -->
            <!-- <small>Respondido por: {{$a->user()->get()->first()->email}}</small> -->
            <!-- <li class="list-group-item">{{$a->answer}}</li> -->
        <!-- @empty -->
            <!-- <li class="list-group-item font-italic">Ainda não há respostas nesse post</li> -->
        <!-- @endforelse -->
    @else
        <h3>Não existe um post com o id {{$id}}</h3>
    @endif

</body>
</html>