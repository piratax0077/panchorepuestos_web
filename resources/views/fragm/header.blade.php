<style>
  .icon_header{
    font-size: 30px;
    margin-right: 5px;
  }

  nav{
    background: #000;
  }

.nav-link-size{
  font-size: 21px;
  box-shadow: inset 0 0 0 0 #f2eb0d;
  color: #f2eb0d;
  margin: 0px 10px 0px 10px;
  padding: 0px;
  transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
 
}
.nav-link-size:hover{
  box-shadow: inset 100px 0 0 0 #f2eb0d;
  color: black !important;
  
}
</style>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <img src="{{asset('assets/images/logo_negro_200.jpeg')}}" alt="" class="logo_header">
      <button class="navbar-toggler" style="background: yellow;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item ">
            <a class="nav-link  nav-link-size text-light" href="{{url('prueba')}}">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  nav-link-size active text-light" aria-current="page" href="{{url('repuestos')}}">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-size  text-light" href="{{url('marcas-repuestos')}}">Marcas</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link nav-link-size text-light" href="{{url('quienes-somos')}}" >
              Quienes Somos
            </a>
          </li>
          
        </ul>
        <!-- Authentication Links -->
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          @if(!Auth::user())
          <li class="nav-item">
              <a class="nav-link nav-link-size text-light" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link nav-link-size text-light" href="{{ route('register') }}">{{ __('Registrar') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->email}}
            </a>
  
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
         
      @endif
        </ul>
       
        <a href="{{url('carrito')}}" style="text-decoration: none; margin-right: 5px;"><i class="fa-solid fa-cart-shopping icon_header" style="color: red !important"></i> 
          <span class="badge bg-danger" style="font-size: 20px;" id="cantidad_items">
          
        </span>
      </a> 
        <form class="d-flex">
          <input class="form-control me-2" type="search" id="tags" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-warning" type="submit" onclick="buscar()">Buscar</button>
        </form>
        
      </div>
    </div>
  </nav>