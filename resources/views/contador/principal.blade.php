@extends('layouts.contador')


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
      <th>ID venta</th> 
      <th>Monto</th>
      <th>Status</th>
      <th>Correo comprador</th>
      <th>Tipo</th>
      <th>Evidencia</th>
      <th>Aceptar/Rechazar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($ventas as $venta)
    <tr>
      <td>{{$venta->id}}</td>
      <td>{{$venta->monto}}</td>
      <td>{{$venta->status}}</td>
      <td>{{$venta->correo}}</td>
      <td>{{$venta->tipo}}</td>
      @if ($venta->tipo=='Deposito')
      <td><a href="{{$venta->evidencia}}" target="_blank">Ver evidencia</a></td>   
      @else
      <td>Transacción</td>   
      @endif
      @if ($venta->tipo=='Deposito' AND $venta->status=='Pendiente')
      <form action="/validar-compra/{{ $venta->id }}" class="form-horizontal" method="post">
        @method('put')
        @csrf
        <td><button type="submit" name='validacion' value='Aceptado' class="btn btn-primary">Aceptar</button>
        <button type="submit" name='validacion'value='Rechazado' class="btn btn-danger">Rechazar</button></td>
      </form>    
      @else
        <td>{{$venta->status}}</td>   
      @endif
      
    </tr>
    @endforeach
  </tbody>
</table>

      
    
</body>

</body>
</html>
@endsection
