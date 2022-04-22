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
                            <form action="/updateusuario/{{$id}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                @method('put')
                                <fieldset>
                                    <legend class="text-center header">Editar usuario</legend>
                                    <label >ID del usuario</label>
                                    @csrf
                                    {{-- El foreach sirve para poder leer los datos enviados --}}
                                    @foreach ($usuarios as $usuario)
                                    @endforeach
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="id" type="text" value={{$id}} class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Nombre</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="nombre" type="text" value="{{$usuario->nombre}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Apellido paterno</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="descripcion" name="apellido_paterno" type="text" value="{{ $usuario->apellido_paterno }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Apellido materno</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="descripcion" name="apellido_materno" type="text" value="{{ $usuario->apellido_materno }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Correo</label>
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="descripcion" name="correo" type="text" value="{{ $usuario->correo }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label >Rol del usuario</label>
                                    <select class="form-select" name="rol" style="width:auto">
                                        <option>Cliente</option>
                                        <option>Encargado</option>
                                        <option>Contador</option>
                                        <option>Supervisor</option>
                                      </select>
                                    </div>
                                    @if ($usuario->activo==1)
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="activa" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Usuario activo</label>
                                              </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($usuario->activo==0)
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="activa">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Usuario activo</label>
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