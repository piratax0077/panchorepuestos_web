@extends('layouts.app')

@section('javascript')
<script>
    window.onload = function(){
        function dame_marcas(){
                $.ajax({
                    type:'get',
                    url: 'http://panchoserver.ddns.net/api/ruta_prueba',
                    beforeSend: function(){
                        $('#mensaje').empty();
                        $('#mensaje').append('<img src="{{asset("assets/images/loading6.gif")}}" alt="Cargando ...">');
                    },
                    success: function(marcas){
                        $('#mensaje').empty();
                        $('#imagenes_marcas').empty();
                      
                        marcas.forEach(marca => {
                            
                            $('#imagenes_marcas').append("<div class='col-md-2 col-sm-6 col-6 '><img src='http://panchoserver.ddns.net/storage/"+marca.urlfoto+"' alt='' class='imagen_marca_banner'> </div>");
                            
                 
                        });
                        
                    },
                    error: function(error){
                        console.log(error.responseText);
                    }
                });
            }

            dame_marcas();
    }

    function cargar_Modelos(idmarca)
    {
      if(idmarca==0)
      {
        swal({
            text: 'Elija una marca',
            position: 'top-end',
            icon: 'warning',
            toast: true,
            showConfirmButton: false,
            timer: 3000,
        });
        return false;
      }

      var url_buscar='http://panchoserver.ddns.net/api/damemodelos_por_marca/'+idmarca;

      $.ajax({
       type:'GET',
       beforeSend: function () {
      },
      url:url_buscar,
      success:function(resp){
        console.log(resp);
      },
      error: function(error){
        
        console.log(error.responseText);

      }
      });
    }

    
</script>
@endsection

@section('content')
<div class="container">
<p id="mensaje"></p>
    <div id="imagenes_marcas" class="row">
    
    </div>
</div>

@endsection