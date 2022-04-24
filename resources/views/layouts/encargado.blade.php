<!doctype html>
<html lang="en">
  <head>
    <link href="{{ asset('css/contenido.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
      </head>
  <body>
    <!-- Navbar -->
<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <!-- Container wrapper -->
  <!-- Navbar brand -->
  <a class="navbar-brand mt-2 mt-lg-0" href="#">
    <img
      src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
      height="15"
      alt="MDB Logo"
      loading="lazy"
    />
  </a>
  <!-- Left links -->
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link"  href="/registrar-cliente">Registrarse</a>
  </ul>
  <!-- Left links -->
</div>
<!-- Collapsible wrapper -->

<!-- Right elements -->
<div class="d-flex align-items-center">
  <!-- Icon -->
  <a class="text-reset me-3" href="#">
    <i class="fas fa-shopping-cart"></i>
  </a>

  <div class="col-4 text-right barra">
    <ul class="navbar-nav mr-auto">
        <li>
              <a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-user-circle user"></i></a>

           <div class="dropdown-menu" aria-labelledby="navbar-dropdown ">
                <a class="dropdown-item menuperfil cerrar" href="/login"><i
                    class="fas fa-sign-out-alt m-1"></i>Salir
                </a>
            </div>
        </li>
    </ul>
</div>

    </ul>
  </div>
  <!-- Container wrapper -->
</nav>

<div class="recuadro">
    <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="/principal-encargado" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Productos no consignados</span>
        </a>
      </div>
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="/productosdes" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Desconsignar producto</span>
        </a>
      </div>
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="/usuarios" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Usuarios</span>
        </a>
      </div>
      
    </div>
  </nav>
  <!-- Sidebar -->
</div>


  <div class="recuadro" id="dos">
          @yield('content')<!-- contenido -->
  </div>
    


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/646c794df3.js"></script>
  </body>
</html>