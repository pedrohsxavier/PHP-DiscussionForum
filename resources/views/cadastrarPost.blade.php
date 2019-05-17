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
    <form method="POST" action="{{url('post/cadastrar')}}">
        @csrf
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" aria-describedby="Titulo do Post" placeholder="Digite o título do Post">
        </div>

        <div class="form-group">
            <label for="texto">Post</label>
            <input type="text" class="form-control" id="texto" name="texto" aria-describedby="Texto do Post" placeholder="Digite o texto do Post">
        </div>

        <div class="form-group">
            <select name="tema" id="tema">
                @foreach($temas as $t)
                    <option value="{{$t->id}}">{{$t->theme}}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>
</body>
</html>