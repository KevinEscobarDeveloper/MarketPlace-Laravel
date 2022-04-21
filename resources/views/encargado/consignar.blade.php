@extends('layouts.encargado')


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
                            	
                                    <legend class="text-center header">Consignar producto</legend>
                                    
                                    @php
                                     $opcion='Si';   
                                    @endphp
                                    <main style="margin-top: 58px;">
                                        <div class="container pt-4">
                                    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                                  width="100%">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Nombre</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($productos as $producto)
                                    <tr>
                                      <td>{{$producto->id}}</td>
                                      <td>{{$producto->nombre}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                @if (empty($valores['opciones']))
                                <form action="/rconsignar/{{$producto->id}}" class="form-horizontal" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">¿Desea consignar el producto?</label>
                                            <select class="form-control" id="opciones" name="opciones">
                                                <option>Si</option>
                                                <option>No</option>
                                              </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg">enviar</button>
                                </form>
                                 @endif     
                                @if (!empty($valores['opciones']))
                                @if ($valores['opciones']=='No')
                                <form action="/updateconsignar/{{$id}}" class="form-horizontal" method="post">
                                    @method('put')
                                    <label >¿Producto consignado</label>
                                    @csrf
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="opciones" type="text" value='No' class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="motivo" type="text" placeholder="Motivo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                                        </div>
                                    </div>
                                    @if (!empty($mensaje))
                                    <label >{{$mensaje}}</label>
                                    @endif
                                </form>
                                    @endif
                                    @endif
                                   
                                    @if (!empty($valores['opciones']))
                                    @if ($valores['opciones']=='Si')
                                    <form action="/updateconsignar/{{$id}}" class="form-horizontal" method="post">
                                        @method('put')
                                    <label >¿Producto consignado</label>
                                    @csrf
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="opciones" type="text" value='Si' class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                            <div class="col-md-8">
                                            <label for="exampleFormControlSelect1">Porcentaje de manejo</label>
                                            <input id="fname" name="consecionado" type="number" placeholder="Porcentaje de manejo" 
                                                class="form-control" max="100">
                                          </div>
                                        <div class="form-group">
                                            <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                                            </div>
                                        </div>
                                        @if (!empty($mensaje))
                                            <label >{{$mensaje}}</label>
                                        @endif
                                    </div>
                                </form>
                                    @endif
                                    @endif
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main>
    
</body>

</body>
</html>
@endsection

