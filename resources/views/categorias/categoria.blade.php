@extends('layouts.barra')


@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cliente</title>
    <link href="{{ asset('css/productos.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <scritp src="popper/popper.min.js"></script>
    <script src="plugin/sweetalert2/sweetalert2.all.min.js"></script>

 
</head>
<form  class="form"  action="total.php" method="post">
    <h1>Productos</h1>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
        <tr>
            <td>Arroz</td>
            <td>10</td>
            <td><input type="number" id="p1" name="p1" placeholder="0" min="0" value=0></td>
        </tr>
        <tr>
            <td>leche</td>
            <td>21</td>
            <td><input type="number" id="p2" name="p2" placeholder="0" min="0" value=0></td>
        </tr>
        <tr>
            <td>Atún</td>
            <td>10</td>
            <td><input type="number" id="p3" name="p3" placeholder="0" min="0" value=0></td>
        </tr>

    </table>
    <input type="submit" name="submit"  value="Calcular">
</form>
    

</body>

</html>
@endsection

