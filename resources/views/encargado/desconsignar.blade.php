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
                            	
                                    <legend class="text-center header">Desconsignar producto</legend>
                                    
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
                                <form action="/updatedesconsignar/{{$producto->id}}" class="form-horizontal" method="post">
                                    @method('put')   
                                    @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">¿Desea consignar el producto?</label>
                                            <select class="form-control" id="opcion" name="opcion">
                                                <option>Si</option>
                                              </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg">enviar</button>
                                    
                                        @if (!empty($mensaje))
                                        <label >{{$mensaje}}</label>
                                    @endif
                                </form> 
                                    </div>
                                </main>
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

