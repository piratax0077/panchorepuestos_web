@extends('layouts.app')


@section('javascript')
<script>
    $( function() {
        $.ajax({
                    type:'get',
                    url: 'http://panchoserver.ddns.net/api/repuestos',
                    beforeSend: function(){
                        $('#mensaje').html('CARGANDO ...');
                    },
                    success: function(repuestos){
                        let contador = 0;
                        let fotos = repuestos[1];
                        $('#mensaje').html('LISTO');
                      
                        let container = $('#pagination');
                        container.pagination({
                            dataSource: repuestos[0],
                            pageSize: 10,
                            callback: function (data, pagination) {
                                var dataHtml = '<div class="row w-100">';

                                $.each(data, function (index, item) {
                                    dataHtml += `
                                    <div class="col-md-3 mb-3">
                                    <div class="card">
                                    <img class="card-img-top repuestos_image"  src="http://panchoserver.ddns.net/storage/`+fotos[contador].urlfoto+`" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">`+item.descripcion+`</h5>
                                        <p class="card-text">$ `+item.precio_venta+`</p>
                                        <p class="card-text">Stock: `+item.stock_actual+`</p>
                                        <a href="#" class="btn btn-warning">Añadir al carrito</a>
                                        <a href="/repuesto/`+item.id+`" class="btn btn-primary">Descripción</a>
                                    </div>
                                    </div>
                                    </div>
                                    `;
                                    contador++;
                                });

                                dataHtml += '</div>';

                                $("#container").html(dataHtml);
                            }
                        });

                    },
                    error: function(error){
                        console.log(error.responseText);
                    }
                });
  } );
   


</script>
@endsection
@section('content')
<div class="container">
    <h1>Repuestos</h1>
    <p id="mensaje"></p>
    <section>
        <div id="container"></div>
        <div id="pagination"></div>
    </section>
</div>


@endsection