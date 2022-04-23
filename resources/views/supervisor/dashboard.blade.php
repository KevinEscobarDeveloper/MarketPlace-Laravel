<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/tablero.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center align-content-center">
            <div class="col-8 barra">
                <h4 class="text-light">ADMINISTRADOR</h4>
            </div>
            <div class="col-4 text-right barra">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-user-circle user"></i></a>

                        <div class="dropdown-menu" aria-labelledby="navbar-dropdown ">
                            <a class="dropdown-item menuperfil cerrar" href="cerrar.php"><i
                                    class="fas fa-sign-out-alt m-1"></i>Salir
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <div class="row">
            <div class="barra-lateral col-12 col-sm-auto">
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                    <a href="#"><i class="fas fa-home"></i><span>Inicio</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="container">
                    <div class="row">

                        <div class="bg-success text-white text-center m-1">
                            <div class="card-header">Total vendidos</div>
                            <div class="card-body">
                                <h5 class="card-title"><span id="idVendidos">15</span></h5>
                                <p class="card-text">Baja en las ventas vs mes anterior</p>
                            </div>
                        </div>

                        <div class="bg-warning text-white text-center m-1">
                            <div class="card-header">Total en almacen</div>
                            <div class="card-body">
                                <h5 class="card-title"><span id="idVendidos">25</span></h5>
                                <p class="card-text">Inventario mayor vs mes anterior</p>
                            </div>
                        </div>

                        <div class="bg-info text-white text-center m-1">
                            <div class="card-header">Total Ingresos</div>
                            <div class="card-body">
                                <h5 class="card-title"><span id="idVendidos">105</span></h5>
                                <p class="card-text">Disminución de ingresos vs mes anterior</p>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="bar-chart" width="800" height="250"></canvas>
                <script>
                // Bar chart
                new Chart(document.getElementById("bar-chart"), {
                    type: 'bar',
                    data: {
                        labels: ["Arroz", "Leche", "Atún"],
                        datasets: [{
                            label: "Ganancias (pesos)",
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
                            data: [2008, 3067, 934]
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Ganancias de productos en el mes'
                        }
                    }
                });
                </script>

            </main>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>
</body>

</html>
