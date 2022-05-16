@extends('layouts.cliente')


@section('content')
<!DOCTYPE html>
<html>
    
<head>
    <link href="{{ asset('css/contenido.css')}}" rel="stylesheet">
    <link href="{{ asset('css/raitingbar.css')}}" rel="stylesheet">
    <link href="{{ asset('css/raitingbar2.css')}}" rel="stylesheet">
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
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Calificación</th>
      <th>Calificar compra</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productos as $producto)
    <tr>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->descripción}}</td>
      <td>{{$producto->precio}}</td>
      
      <td>
        @if(!empty($producto->calificacion))
        <div class=" container d-flex justify-content-center align-items-center">

              <div class="d-flex justify-content-between align-items-center">
                  <div class="ratings">
                    @for($i=0; $i< (int)$producto->calificacion; $i++)
                      <i class="fa fa-star rating-color"></i>
                    @endfor
                  </div>
              </div>
          </div>
          @endif
      </td>
      @if(empty($producto->calificacion))
      <td><form action="/calificar-transaccion/{{$producto->tid}}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="rating[post_id]" value="3" >
        <button type="submit" name="rating[rating]" value="5" >&#9733;</button>
        <button type="submit" name="rating[rating]" value="4" >&#9733;</button>
        <button type="submit" name="rating[rating]" value="3">&#9733;</button>
        <button type="submit" name="rating[rating]" value="2">&#9733;</button>
        <button type="submit" name="rating[rating]" value="1">&#9733;</button>
      </form></td> 
    </tr>
    @endif
    @if(!empty($producto->calificacion))
      <td>Transacción ya calificada</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>
    @endif

      
    
</body>

</body>
</html>
@endsection
