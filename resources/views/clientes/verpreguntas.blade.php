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
    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
  <thead>
    <tr>
      <th>Producto</th>
      <th>Pregunta</th>
      <th>Ver pregunta</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($preguntas as $pregunta)
    @if (empty($pregunta->respuesta))
    <tr>
      <td>{{$pregunta->pnombre}}</td>
      <td>{{$pregunta->nombre}} {{$pregunta->apellido_paterno}} {{$pregunta->apellido_materno}}</td>
      <td><a href="/verpregunta/{{$pregunta->idp}}" class="btn btn-success">Ver pregunta</a></td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>
      
    
</body>

</body>
</html>
@endsection
