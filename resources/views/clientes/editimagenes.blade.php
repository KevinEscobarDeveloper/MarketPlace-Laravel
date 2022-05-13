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

    <main style="margin-top: 58px;">
        <div class="container pt-4">
 


<style>
  table, th, td{
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
</head>
<body>
<table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
width="100%">
  <tr>
    <th>Producto</th>
    <th>Imagenes</th>
  </tr>
 
  <tr>
    @foreach ($productos as $producto) 
    <td><div class="form-group">
      <span class="col-md-1 col-md-offset-2 text-center"></i></span>
      <div class="col-md-8">
          <input id="nombre" name="nombre" type="text" value="{{$producto->nombre}}" class="form-control" readonly>
      </div>
    </div></td>
        <a href="/formimagen/{{$producto->id}}" class="btn btn-primary">Agregar imagen</a>
    @endforeach
    <td>
      <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
width="100%">
      @php
      
      $contador=0;
      @endphp
          @foreach ($imagenes as $imagen)
          <tr>
            <td><a href={{$imagen->nombre}}> Ver imagen {{$contador+=1}}</a></td>
        </tr>
          <td>
            <a href="/cambiarimagen/{{$imagen->id}}" class="btn btn-info">Cambiar imagen</a>
             <form action="deleteimagen/{{$imagen->id}}" class="form-horizontal" method="post">
              @csrf
                    <input id="nombre" name="nombre" type="text" value="{{$producto->nombre}}" class="form-control" hidden>
              @method('DELETE')
          <button type="submit" class="btn btn-danger">Borrar</button>
          </form>
          </td>
            @endforeach
       
      </table>
    </td> 
  </tr>
</table>
</div>
        
</body>

</body>
</html>
@endsection
