@extends('layouts.app')

@section('javascript')
<script>
    
        //Se recupera la url actual
        var URLactual = window.location;
        //Convertimos la url a string para poder rescatar el id del repuesto
        var strurl = String(URLactual);
        //Separamos el string y dejamos solo el id
        var id_array = strurl.split('/');
        var id_repuesto = id_array[4];

        var cantidad = 0;
        var precio_total = 0;
        window.onload = function(){
          dame_repuesto(id_repuesto);
        }
        
    
    

    function dame_repuesto(repuesto_id){
    let url = 'http://panchoserver.ddns.net/api/'+repuesto_id+'/repuesto';
    $.ajax({
        type:'get',
        url: url,
        beforeSend: function(){
          $('#mensaje').empty();
          $('#mensaje').append('<img src="{{asset("assets/images/loading6.gif")}}" alt="Cargando ...">');
        },
        success: function(data){
           console.log(data[2]);
            $('#mensaje').empty();
            let repuesto = data[0];
            
            let fotos = data[1];
            let precio_format = Number(repuesto.precio_venta).toFixed(0);
            precio_total = precio_format;
            $('#titulo_repuesto').empty();
            $('#codigo_interno').empty();
            $('#stock_actual').empty();
            $('#precio').empty();
            
            $('#titulo_repuesto').append(repuesto.descripcion);
            $('#codigo_interno').append(repuesto.codigo_interno);
            $('#stock_actual').append(repuesto.stock_actual);
            $('#precio').append('$ '+precio_format);
            $('#carousel-inner').empty();
            $('#carousel-inner').append(`
            <div class="carousel-item active">
                <img class="d-block w-100 fotos_repuesto" src="http://panchoserver.ddns.net/storage/`+fotos[0].urlfoto+`" alt="First slide">
              </div>
            `);
            fotos.forEach(foto => {
                $('#carousel-inner').append(`
                    <div class="carousel-item">
                        <img src="http://panchoserver.ddns.net/storage/`+foto.urlfoto+`" class="d-block w-100 fotos_repuesto" alt="`+repuesto.descripcion+`">
                    </div>
                `);
            });

            let similares = data[2];

            let container = $('#pagination');
                        container.pagination({
                            dataSource: similares,
                            pageSize: 4,
                            callback: function (data, pagination) {
                                var dataHtml = "";

                                $.each(data, function (index, similar) {
                                    
                                    dataHtml += `
                                    <tr>
                                      <td>`+similar.marcanombre+`</td>  
                                      <td>`+similar.modelonombre+` </td>
                                      <td>`+similar.anios_vehiculo+` </td>
                                    </tr>
                                    `;
                                    
                                });

                                dataHtml += '</div>';

                                $("#container").html(dataHtml);
                            }
                        });
            
            
        },
        error: function(error){
            console.log(error.responseText);
        }
    })
    
}

function agregar_carrito(){
  let url = '/agregar_carrito';
  let cantidad = $('#cantidad').val();
  let total = (precio_total * cantidad);

  let params = {
    id_repuesto : id_repuesto,
    cantidad: cantidad,
    precio_neto: precio_total,
    total: total
  };
  
  $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      
  $.ajax({
    type:'post',
    url: url,
    data: params,
    success: function(resp){
      
      if(resp == 'OK'){
        agregar_carrito_virtual();
      }else{
        swal({
          title:'error',
          text:'Repuesto ya está ingresado al carrito',
          icon:'error'
        });
      }
    },
    error: function(error){
      swal({
                    title: "Error",
                    text: error.responseText,
                    icon: "error"
                });
    }
  })
}

function agregar_carrito_virtual(){
  let cantidad = $('#cantidad').val();
  let usuario_id = $('#usuario_id').val();
  let url = 'http://panchoserver.ddns.net/api/agregar_carrito_virtual/'+id_repuesto+"/"+cantidad+"/"+usuario_id;
      
  $.ajax({
    type:'get',
    url: url,
    success: function(resp){
      
      if(resp == 'OK'){
        swal({
                    title: "Felicidades",
                    text: "Repuesto agregado al carrito",
                    icon: "success"
                });
        
        setTimeout(() => {
          // Simulate a mouse click:
          window.location.href = "/carrito";
        }, 3000);
      }else{
        swal({
          title:'error',
          text:'Repuesto ya está ingresado al carrito',
          icon:'error'
        });
      }
    },
    error: function(error){
      swal({
                    title: "Error",
                    text: error.responseText,
                    icon: "error"
                });
    }
  });
}

function aumentar(){
  let cantidad = $('#cantidad').val();
  let aumentado = parseInt(cantidad) + 1;
  $('#cantidad').val(aumentado);
}

function disminuir(){
  let cantidad = $('#cantidad').val();
  if(cantidad > 1){
    let disminuido = parseInt(cantidad)- 1;
    $('#cantidad').val(disminuido);
  }else{
    $('#cantidad').val(1);
  }
  
}
</script>
@endsection

@section('content')
    
<div class="container">
  <p id="mensaje"></p>
    
    
    <div class="repuesto_tienda">
      <h2 id="titulo_repuesto"></h2>
        <div class="row">
            <div class="col-md-4">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carousel-inner">
                      
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
            <div class="col-md-8">
                <p>Descripción</p>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Código Interno</th>
                        <th scope="col">Stock actual</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col"></th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row" id="codigo_interno"></th>
                        <td id="stock_actual"></td>
                        <td id="precio"></td>
                        <td style="display: flex">
                          <button class="btn btn-warning btn-sm" onclick="disminuir()">-</button>
                          <input type="number" class="text-center" name="cantidad" id="cantidad" min="0" value="1" >
                          <button class="btn btn-warning btn-sm" onclick="aumentar()">+</button>
                        </td>
                        <td>@if(Auth::user())<button class="btn btn-success btn-sm" onclick="agregar_carrito()">Agregar</button> @else <p class="text-danger">Debe estar registrado</p> @endif</td>
                      </tr>
                      
                    </tbody>
                  </table>
                  
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Años</th>
          
                          </tr>
                        </thead>
                        <tbody id="container">
                          <div id="pagination"></div>
                        </tbody>
                      </table>
            </div>
        </div>
        
    </div>
    
</div>

@if(Auth::user())<input type="hidden" name="" id="usuario_id" value="{{Auth::user()->id}}">@endif
    
@endsection