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
        <th>ID</th> 
        <th>Monto</th>
        <th>Status</th>
        <th>Vendedor</th>
        <th>Editar pago</th>
        <th>Marcar como entregado</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pagos as $pago)
      <tr>
        <td>{{$pago->id}}</td>
        <td>{{$pago->pago}}</td>
        <td>{{$pago->estado}}</td>
        <td>{{$pago->nombre}}</td>
        
        @if ($pago->estado=='Pendiente')  
        <form action="editar-pago/{{$pago->id}}" class="form-horizontal" method="get">
            @csrf
            <td><button type="submit" name='validacion' value='Aceptado' class="btn btn-primary">Editar</button>
        </form>
        @endif
        @if ($pago->estado=='Entregado')
        <form action="" class="form-horizontal" method="get">
          @csrf
          <td><button type="submit" name='validacion' value='Aceptado' class="btn btn-primary" disabled>Editar</button>
      </form>
        @endif
        @if ($pago->estado=='Pendiente')  
        <form action="entregar-pago/{{$pago->id}}" class="form-horizontal" method="post">
          @method('put')
          @csrf
          <td><button type="submit" name='validacion' value='Aceptado' class="btn btn-warning">Entregado</button></td>
      </form> 
        @endif 
        @if ($pago->estado=='Entregado')
        <form action="" class="form-horizontal" method="post">
          @method('put')
          @csrf
          <td><button type="submit" name='validacion' value='Aceptado' class="btn btn-warning" disabled>Entregado</button></td>
      </form>
        @endif 
         

      </tr>
      @endforeach
  
  </tbody>
</table>

      
    
</body>

</body>
</html>
@endsection
