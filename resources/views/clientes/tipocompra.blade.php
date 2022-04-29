@extends('layouts.cliente')


@section('content')
<!DOCTYPE html>
<html>
    
<head>
    <link href="{{ asset('css/registro.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"> 
</head>

<body>
    <main style="margin-top: 10px;">
        <div class="container pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm">
                            
                                    {{-- El foreach sirve para poder leer los datos enviados --}}
                                    @foreach ($usuarios as $usuario)
                                    @endforeach
                                    @foreach ($productos as $producto)
                                    @endforeach
                                    @if ($valores['tipocompra']=='Compra en linea')
                                    <legend class="text-center header">Usted a comprado el producto</legend>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="id" type="text" value={{$producto->nombre}} class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Precio</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="nombre" type="text" value="{{$producto->precio}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <td><a href="/comprar/{{$producto->id}}" class="btn btn-success">Volver</a></td>
                                    @endif
                                    @if ($valores['tipocompra']=='Por banco')
                                    <form action="/tipocompra/{{$id}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                        <legend class="text-center header">Compra status</legend>
                                        @csrf
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="id" type="text" value={{$producto->nombre}} class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Precio</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="precio" type="text" value="{{$producto->precio}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Tipo de pago</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="tipocompra" type="text" value="Por banco" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Agregue su comprobante</label>
                                            <input type="file" class="form-control-file" id="comprobante" name="comprobante">
                                          </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Comprar</button>
                                        </fieldset>
                                    @if (!empty($mensaje))
                                    <label >{{$mensaje}}</label>
                                    @endif
                                </form>
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main>
</body>
</html>