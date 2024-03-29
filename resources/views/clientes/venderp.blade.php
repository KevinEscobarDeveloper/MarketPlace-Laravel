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
                            	
                            <form action="/propuesta" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <legend class="text-center header">Agregue su propuesta</legend>
                                    @csrf
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <label >Nombre del producto</label>
                                            <input id="nombre" name="nombre" type="text" placeholder="Nombre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <label >Descripción</label>
                                            <input id="descripcion" name="descripcion" type="text" placeholder="Descripción" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <label >Precio</label>
                                            <input id="precio" name="precio" type="number" placeholder="Precio" class="form-control" min="0">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <label >Existencia</label>
                                            <input id="existencia" name="existencia" type="number" placeholder="existencia" class="form-control" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                    <select class="form-select" name="categoria" style="width:auto">
                                        @foreach ($categorias as $categoria)
                                        <option>{{$categoria->nombre}}</option>
                                      @endforeach
                                    </select>
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Agregue su imagen</label>
                                            <input type="file" class="form-control-file" id="imagen[]" name="imagen[]" multiple
                                            accept="image/*" required>
                                          </div>
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                                        </div>
                                    </div>
                                </fieldset>
                                @if (!empty($mensaje))
                                    <label >{{$mensaje}}</label>
                                    @endif
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
