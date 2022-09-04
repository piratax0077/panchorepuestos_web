@extends('layouts.app')

@section('javascript')
<script>
    var user_id;
    
    //Luego de que cargue la página en su totalidad ejecutamos la función para saber el id del usuario
    window.onload = function(){
        user_id = $('#user_id').val();
        dame_carrito(user_id);
    }

    function dame_carrito(user_id){
        let url = 'http://panchoserver.ddns.net/api/revisar_carrito/'+user_id;

        $.ajax({
            type:'get',
            url: url,
            success: function(repuestos){
                console.log(repuestos);
               if(repuestos[0].length == 0){
                $('#mensaje').empty();
                $('#mensaje').append('<h2 class="alert-danger">Carrito vacio </h2>');
               }else{
                let contador = 0;
                        let fotos = repuestos[1];
                        $('#mensaje').html('LISTO');
                        let monto_total = 0;
                        let container = $('#pagination');
                        container.pagination({
                            dataSource: repuestos[0],
                            pageSize: 10,
                            callback: function (data, pagination) {
                                var dataHtml = '<div class="row w-100">';
                                
                                $.each(data, function (index, item) {
                                    let precio_format = Number(item.precio_venta).toFixed(0);
                                    monto_total += (item.cantidad * precio_format);
                                    dataHtml += `
                                    <div class="col-md-4 col-lg-3 mb-3">
                                    <div class="card">
                                    <img class="card-img-top repuestos_image"  src="http://panchoserver.ddns.net/storage/`+fotos[contador].urlfoto+`" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">`+item.descripcion+`</h5>
                                        <p class="card-text">Cantidad: `+item.cantidad+`</p>   
                                        <p class="card-text">Precio unitario: $ `+precio_format+`</p>
                                        <p class="card-text">Stock: `+item.stock_actual+`</p>
                                        <p class="card-text">Subtotal: $ `+(item.cantidad * precio_format)+` </p>
                                    </div>
                                    <button class="btn btn-danger btn_eliminar_item_carrito" onclick="eliminar_item_carrito(`+item.id+`)">X</button>
                                    </div>
                                    
                                    </div>
                                    
                                    `;
                                    contador++;
                                });

                                dataHtml += '</div>';
                                $('#resumen').empty();
                                $('#resumen').append('<h1>$ '+monto_total+' </h1> <img src="{{asset("assets/images/webpay.png")}}" alt="" class="image_transbank_carrito"> <button class="btn btn-success" onclick="pagar('+monto_total+')">Pagar </button>');
                                $("#container").html(dataHtml);
                            }
                        });
               }
                
            },
            error: function(error){
                console.log(error.responseText);
            }
        })
    }

    function eliminar_item_carrito(idrep){
        let url = '/eliminar_item_carrito';
        let params = {
            idrep: idrep,
            user_id: user_id
        }

        $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            type:'post',
            data: params,
            url: url,
            success: function(resp){
                
                $('#cantidad_items').empty();
                $('#cantidad_items').append(resp);
                eliminar_item_carrito_virtual(idrep);
            },
            error: function(error){
                console.log(error.responseText);
            }
        })
    }

    function eliminar_item_carrito_virtual(idrep){
        let url = 'http://panchoserver.ddns.net/api/eliminar_item_carrito/'+idrep+'/'+user_id;
        
        $.ajax({
            type:'get',
            url: url,
            success: function(repuestos){
                let contador = 0;
                        let fotos = repuestos[1];
                        $('#mensaje').html('LISTO');
                        let monto_total = 0;
                        let container = $('#pagination');
                        container.pagination({
                            dataSource: repuestos[0],
                            pageSize: 10,
                            callback: function (data, pagination) {
                                var dataHtml = '<div class="row">';

                                $.each(data, function (index, item) {
                                    let precio_format = Number(item.precio_venta).toFixed(0);
                                    monto_total += (item.cantidad * precio_format);
                                    dataHtml += `
                                    <div class="col-md-4 col-lg-3 mb-3">
                                    <div class="card">
                                    <img class="card-img-top repuestos_image"  src="http://panchoserver.ddns.net/storage/`+fotos[contador].urlfoto+`" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">`+item.descripcion+`</h5>
                                        <p class="card-text">Cantidad: `+item.cantidad+`</p>   
                                        <p class="card-text">Precio unitario: $ `+precio_format+`</p>
                                        <p class="card-text">Stock: `+item.stock_actual+`</p>
                                        <p class="card-text">Subtotal: $ `+(item.cantidad * precio_format)+` </p>
                                    </div>
                                    <button class="btn btn-danger btn_eliminar_item_carrito" onclick="eliminar_item_carrito(`+item.id+`)">X</button>
                                    </div>
                                    
                                    </div>
                                    
                                    `;
                                    contador++;
                                });

                                dataHtml += '</div>';
                                $('#resumen').empty();
                                $('#resumen').append('<h1>$ '+monto_total+' </h1> <img src="{{asset("assets/images/webpay.png")}}" alt="" class="image_transbank_carrito"> <button class="btn btn-success" onclick="pagar('+monto_total+')">Pagar </button>');
                                $("#container").html(dataHtml);
                            }
                        });
            },
            error: function(error){
                console.log(error);
            }
        })
    }
    
    function pagar(monto_total){
        let url = '/iniciar_pago';
        let total = monto_total;
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        let params = {
            session_id : "123456",
            total: total,
            status: 1
        }

        $.ajax({
            type:'post',
            url: url,
            data: params,
            success: function(url_pago){
                
                // Simulate a mouse click:
                window.location.href = url_pago;
            },
            error: function(error){
                console.log(error.responseText);
            }
        })
    }
</script>
@endsection

@section('content')
<div class="container-fluid">
    <h1>Carrito</h1>
    <p id="mensaje"></p>
    <div class="row">
        <div class="col-md-3">
            <h3>Resumen</h3>
            <div id="resumen">

            </div>
        </div>
        <div class="col-md-9">
            <section>
                <div id="container"></div>
                <div id="pagination"></div>
            </section>
        </div>
    </div>
    
</div>

@if(Auth::user())<input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">@endif
@endsection