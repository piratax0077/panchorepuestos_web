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
   
function dame_repuesto(repuesto_id){
    let url = 'http://panchoserver.ddns.net/api/'+repuesto_id+'/repuesto';
    $.ajax({
        type:'get',
        url: url,
        beforeSend: function(){
            $('#modal_informacion_repuesto').empty();
            $('#modal_informacion_repuesto').append('Cargando ...');
        },
        success: function(repuesto){
            $('#modal_informacion_repuesto').empty();
            $('#modal_informacion_repuesto').append(repuesto.descripcion);
        },
        error: function(error){
            console.log(error.responseText);
        }
    })
    
}

</script>
@endsection
@section('content')
<h1>Repuestos</h1>
<p id="mensaje"></p>
<section>
    <div id="container"></div>
    <div id="pagination"></div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_informacion_repuesto">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection