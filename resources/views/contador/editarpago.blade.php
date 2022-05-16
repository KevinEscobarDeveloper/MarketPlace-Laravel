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
@foreach ($ventas as $venta)
    
@endforeach
@foreach ($usuarios as $usuario)
    
@endforeach
@foreach ($pagos as $pago)
    
@endforeach
  <form action="/update-pago/{{ $usuario->id }}" class="form-horizontal" method="post">
    @method('put')
    @csrf
    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
  <thead>
    <tr>
      <th>Producto</th> 
      <th>Vendidos</th>
      <th>precio por pieza</th>
      <th>consecionado</th>
      <th>pago por producto</th>
      <th>Añadir a pago actual</th>
    
     

    </tr>
  </thead>
  <tbody>
    @foreach ($usuarios as $usuario)
    <div class="form-group">
      <label>Vendedor</label>
      <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
      <div class="col-md-8">
          <input id="fname" name="nombre" type="text" value="{{$usuario->nombre}}" class="form-control" readonly>
      </div>
      <label>Monto actual</label>
      <div class="col-md-8">
          <input id="fname" name="montot" type="text" value="{{$pago->pago}}" class="form-control" readonly>
      </div>
      <label>ID Pago</label>
      <div class="col-md-8">
          <input id="fname" name="id" type="text" value="{{$pago->id}}" class="form-control" readonly>
      </div>
      
   @php
     $contador=0;  
   @endphp
    @endforeach
    @foreach ($ventas as $venta)

    <tr>
      <td>{{$venta->nombre}}</td>
      <td>{{$venta->vendidos}}</td>
      <td>{{$venta->precio}}</td>
      <td>{{$venta->consecionado}}</td>
      <div class="form-group">
            <td><input id="papellido" name="precios[{{$venta->id}}]" type="text"
              value="{{($venta->vendidos*$venta->precio)-(($venta->consecionado/100)*$venta->vendidos*$venta->precio)}}" 
              class="form-control" readonly></td>
        </div>
      <td><div class="form-group">
        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
        <div class="col-md-8">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="productos[{{$venta->id}}]]" value="{{$venta->id}}">
                <label class="form-check-label" for="flexSwitchCheckChecked">añadir</label>
              </div>
        </div>
    </div></td>
    </tr>
            
    @endforeach
    
  </tbody>
</table>

  <button type="submit" name='pago'value='pago' class="btn btn-info">Actualizar</button></td>
</form> 
      
    
</body>

</body>
</html>
@endsection
