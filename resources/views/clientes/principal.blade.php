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
            @if(!empty($categorias))
            <main style="margin-top: 58px;">
              <div class="container pt-4">
            @foreach ($categorias as $categoria)
    <div class="recuadro" id="uno">
        <div class="card" style="width: 14rem;">
            <img class="card-img-top" width ="50px" src={{$categoria->imagen}}>
            <div class="card-body">
            <h5 class="card-title">{{ $categoria->nombre }}</h5>
            <p class="card-text">{{ $categoria->descripción }}</p>
            <a href="/cliente{{ $categoria->nombre }}" class="btn btn-primary">Ir a la categoria</a>
            </div>
        </div>
    </div>
    @endforeach
    @endif
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
      <th>Consecionado</th>
      <th>Motivo</th>
      <th>Existencia</th>
      <th>Pendiente</th>
      <th>Preguntar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productos as $producto)
    <tr>
      <td>{{$producto->catnombre}}</td>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->descripción}}</td>
      <td>{{$producto->precio}}</td>
      <td><img class="card-img-top" width ="50px" src={{$producto->imagen}}></td>
      <td>{{$producto->consecionado}}</td>
      <td>{{$producto->motivo}}</td>
      <td>{{$producto->existencia}}</td>
      <td>{{$producto->pendientes}}</td>
      <td><a href="/pregunta/{{ $producto->id }}" class="btn btn-primary">Realizar pregunta</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
    @endif
    @if(!empty($cproductos))
    <main style="margin-top: 58px;">
        <div class="container pt-4">
    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Imagen</th>
      <th>Consecionado</th>
      <th>Motivo</th>
      <th>Existencia</th>
      <th>Pendiente</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($cproductos as $cproducto)
    <tr>
      <td>{{$cproducto->nombre}}</td>
      <td>{{$cproducto->descripción}}</td>
      <td>{{$cproducto->precio}}</td>
      <td><img class="card-img-top" width ="50px" src={{$cproducto->imagen}}></td>
      <td>{{$cproducto->consecionado}}</td>
      <td>{{$cproducto->motivo}}</td>
      <td>{{$cproducto->existencia}}</td>
      <td>{{$cproducto->pendientes}}</td>
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
