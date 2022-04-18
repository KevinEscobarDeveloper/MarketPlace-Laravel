@extends('layouts.barra')


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
                            	
                            <form class="form-horizontal" method="post">
                                <fieldset>
                                    <legend class="text-center header">Registro</legend>
                                    @csrf
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="fname" name="nombre" type="text" placeholder="Nombre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="papellido" name="primerapellido" type="text" placeholder="Primer apellido" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="sapellido" name="segundoapellido" type="text" placeholder="Segundo apellido" class="form-control">
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="correo" name="correo" type="text" placeholder="Correo" class="form-control">
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-key bigicon"></i></span>
                                        <div class="col-md-8">
                                            <input id="contraseña" name="constraseña" type="password" placeholder="contraseña" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Agregue su imagen</label>
                                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                                          </div>
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                                        </div>
                                    </div>
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
