@extends('layouts.supervisor')


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
                            <form action="/updatecategoria/{{$id}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                @method('put')
                                <fieldset>
                                    <legend class="text-center header">Editar categoria</legend>
                                    <label >ID de la categoria</label>
                                    @csrf
                                    {{-- El foreach sirve para poder leer los datos enviados --}}
                                    @foreach ($categorias as $categoria)
                                    @endforeach
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="id" type="text" value={{$id}} class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Categoría</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="nombre" type="text" value="{{$categoria->nombre}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Descripción</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="descripcion" name="descripcion" type="text" value="{{ $categoria->descripción }}" class="form-control">
                                        </div>
                                    </div>
                                    @if ($categoria->activa==1)
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="activa" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Categoría activa</label>
                                              </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($categoria->activa==0)
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="activa">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Categoría activa</label>
                                              </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Agregue su imagen</label>
                                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                                          </div>
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
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