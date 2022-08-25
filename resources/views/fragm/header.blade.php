<style>
  .icon_header{
    font-size: 30px;
    margin-right: 20px;
  }

  nav{
    background: #000;
  }

</style>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <img src="http://panchoserver.ddns.net/storage/imagenes/logoOficial.jpeg" alt="" class="logo_header">
      <button class="navbar-toggler" style="background: yellow;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="{{url('prueba')}}">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{url('contacto')}}">Contacto</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Marcas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="marcas_vehiculos">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-light" href="{{url('repuestos')}}">Repuestos</a>
          </li>
        </ul>
        <i class="fa-solid fa-cart-shopping icon_header" style="color: red !important"></i>
        <form class="d-flex">
          <input class="form-control me-2" type="search" id="tags" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-warning" type="submit" onclick="buscar()">Buscar</button>
        </form>
      </div>
    </div>
  </nav>