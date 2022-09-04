
@extends('layouts.app')

@section('javascript')
<script>
      $( function() {
    $( "#accordion" ).accordion();
  } );
  function dame_marcas(){
                $.ajax({
                    type:'get',
                    url: 'http://panchoserver.ddns.net/api/ruta_prueba',
                    beforeSend: function(){
                        $('#imagenes_marcas').empty();
                        $('#imagenes_marcas').append('<div class="text-center"> CARGANDO ... </div>');
                    },
                    success: function(marcas){
                        $('#imagenes_marcas').empty();
                        $('#marcas_select').empty();
                        $('#marcas_select').append("<option value='0'>Marcas </option>");
                        marcas.forEach(marca => {
                            
                            $('#imagenes_marcas').append("<div class='col-md-2 col-sm-6 col-6'><a href='#'> <img src='http://panchoserver.ddns.net/storage/"+marca.urlfoto+"' alt='' class='imagen_marca_banner'>  </a></div>");
                            
                            $('#marcas_select').append("<option value='"+marca.idmarcavehiculo+"'>"+marca.marcanombre+" </option>");
                        });
                        
                    },
                    error: function(error){
                        console.log(error.responseText);
                    }
                });
            }
        

        function activar_selects(){
            $('#marcas_select').removeAttr('disabled');
            $('#modelos_select').attr('disabled');
            $('#anios_vehiculo_select').attr('disabled');
        }

        function damefamilias(){
        
            $.ajax({
                    type:'get',
                    url: 'http://panchoserver.ddns.net/api/familias',
                    beforeSend: function(){
                        $('#familias_select').empty();
                        $('#familias_select').append('<option value="0">Cargando... </option>');
                    },
                    success: function(familias){
                        

                        $('#familias_select').empty();
                        $('#familias_select').append("<option value='0'>Categorías </option>");
                        familias.forEach(familia => $('#familias_select').append(`<option value=`+familia.id+` class="text-uppercase">`+familia.nombrefamilia+` </option>`));
                        
                        
                    },
                    error: function(error){
                        console.log(error.responseText);
                    }
                });
        }

        function buscar(){
            let valor = $('#tags').val();
            alert(valor);
        }

        function dame_modelos(){
            var x = document.getElementById("marcas_select").value;
            let url = 'http://panchoserver.ddns.net/api/'+x+'/damemodelos';
            
            $.ajax({
                type:'get',
                url: url,
                beforeSend: function(){
                    $('#modelos_select').empty();
                    $('#anios_vehiculo_select').empty();
                    $('#modelos_select').append('<option>Cargando ... </option>');
                },
                success: function(modelos){
      
                    $('#modelos_select').removeAttr('disabled');
                    $('#modelos_select').empty();
                    modelos.forEach(modelo => {
                     
                        $('#modelos_select').append(`<option value=`+modelo.id+` >`+modelo.modelonombre+` </option>`);
                        $('#anios_vehiculo_select').append(`<option value=`+modelo.anios_vehiculo+` >`+modelo.anios_vehiculo+` </option>`);
                    });
                },
                error: function(error){
                    console.log(error.responseText);
                }
            });
        }

        function dameaniosvehiculo(){
            var x = document.getElementById("modelos_select").value;
            let url = 'http://panchoserver.ddns.net/api/'+x+'/dameaniosvehiculo';
            
            $.ajax({
                type:'get',
                url: url,
                beforeSend: function(){
                    $('#anios_vehiculo_select').empty();
                    
                    $('#anios_vehiculo_select').append('<option>Cargando ... </option>');
                },
                success: function(modelo){
                    $('#anios_vehiculo_select').empty();
                    $('#anios_vehiculo_select').append(`<option value=`+modelo.anios_vehiculo+` >`+modelo.anios_vehiculo+` </option>`);
                },
                error: function(error){
                    console.log(error.responseText);
                }
            });
        }

        function busqueda_principal(){
            let modelo = $('#modelos_select').val();
            let familia = $('#familias_select').val();
            // Simulate a mouse click:
            if(modelo == 0){
                swal({
                    title: "Error",
                    text: "Debe ingresar un Modelo de Vehículo",
                    icon: "error"
                });
                return false;
            }else{
                window.location.href = "/busqueda_por_modelo/"+modelo+"/"+familia;
            }
           
        }

        function buscar_por_oem(){
            let oem = $('#buscar_por_oem').val();
            if( oem === '' || oem.trim() == 0){
                swal({
                    title: "Error",
                    text: "Debe ingresar un OEM",
                    icon: "error"
                });
                return false;
            }
            window.location.href = "/busqueda_por_oem/"+oem;
        }
                
        dame_marcas();
        damefamilias();
            
</script>
@endsection

@section('content')
@include('fragm.slider')
@include('fragm.buscador')
            @include('fragm.banner')
            @include('fragm.banner2')
            @include('fragm.banner3')
            
@endsection


