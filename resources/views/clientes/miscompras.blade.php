@extends('layouts.cliente')


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

    @if(!empty($productos))
    <main style="margin-top: 58px;">
        <div class="container pt-4">
    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
  <thead>
    <tr>
      <th>Categoria</th> 
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Imagen</th>
      <th>Existencia</th>
      <th>Pendiente</th>
      <th>Preguntar</th>
      <th>Comprar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productos as $producto)
    <tr>
      @php
        $valor=$producto->consignar  
      @endphp
      @if ($valor=='1')
      <td>{{$producto->catnombre}}</td>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->descripción}}</td>
      <td>{{$producto->precio}}</td>
      <td><img class="card-img-top" width ="50px" src={{$producto->imagen}}></td>
      <td>{{$producto->existencia}}</td>
      <td>{{$producto->pendientes}}</td>
      <td><a href="/pregunta/{{ $producto->id }}" class="btn btn-primary">Realizar pregunta</a></td>
      <td><a href="/comprar/{{$producto->id}}" class="btn btn-success">Comprar</a></td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
</div>
    @endif

      
    
</body>

</body>
</html>
@endsection
