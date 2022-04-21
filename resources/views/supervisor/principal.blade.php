@extends('layouts.supervisor')


@section('content')
<!DOCTYPE html>
<html>
    
<head>
    <link href="{{ asset('css/contenido.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"> 
</head>

<body>
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            @foreach ($categorias as $categoria)
    <div class="recuadro" id="uno">
        <div class="card" style="width: 14rem;">
            <img class="card-img-top" width ="50px" src={{$categoria->imagen}}>
            <div class="card-body">
            <h5 class="card-title">{{ $categoria->nombre }}</h5>
            <p class="card-text">{{ $categoria->descripción }}</p>
            <a href="/{{ $categoria->nombre }}" class="btn btn-primary">Ir a la categoria</a>
            <a href="/editarcategoria/{{$categoria->id}}" class="btn btn-success">Editar</a>
            <form action="/borrarcategoria/{{$categoria->id}}" class="form-horizontal" method="post">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-danger">Borrar</button>
            </form>
            </div>
        </div>
    </div>
    @endforeach
        </div>
      </main>
     
    
</body>

</body>
</html>
@endsection