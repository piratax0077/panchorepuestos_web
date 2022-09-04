@extends('layouts.app')

@section('javascript')
<script>

    window.onload = function(){
        //Se recupera la url actual
        var URLactual = window.location;
        //Convertimos la url a string para poder rescatar el id del repuesto
        var strurl = String(URLactual);
        //Separamos el string y dejamos solo el id
        var id_array = strurl.split('/');
        var idmodelo = id_array[4];
        buscar_por_modelo(idmodelo);
    }
    function buscar_por_modelo(idmodelo)
    {

      var url_buscar='http://panchoserver.ddns.net/api/damemodelo_por_marca/'+idmodelo;

      $.ajax({
       type:'GET',
       beforeSend: function () {
      },

      url:url_buscar,

      success:function(repuestos){
        console.log(repuestos);
        let contador = 0;
                        let fotos = repuestos[1];
                        console.log(fotos);
                        $('#mensaje').html('LISTO');
                      if(repuestos[0].length == 0){
                        $('#container').html('<p class="alert-danger">Sin resultados </p>');
                      }else{
                        let container = $('#pagination');
                        container.pagination({
                            dataSource: repuestos[0],
                            pageSize: 10,
                            callback: function (data, pagination) {
                                var dataHtml = ` 
                                <div class="sortBy w-100 m-auto mb-3">
                                    <label for="sort_option">Ordenar por: </label>
                                    <select class="form-control" name="sort_option">
                                    <option value="1">Menor a Mayor Precio </option>
                                    <option value="2">Mayor a Menor Precio </option>
                                    </select>
                                </div>
                                <div class="row w-100">`;

                                $.each(data, function (index, item) {
                                    let precio_format = Number(item.precio_venta).toFixed(0);
                                    dataHtml += `
                                    <div class="col-md-3 mb-3">
                                    <div class="card">
                                    <img class="card-img-top repuestos_image"  src="http://panchoserver.ddns.net/storage/`+fotos[contador].urlfoto+`" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-title">`+item.descripcion+`</h6>
                                        <p class="card-text text-center text-danger font-weight-bold">$ `+precio_format+`</p>
                                        
                                        <a href="/repuesto/`+item.id+`" class="btn btn-warning w-100">Descripción</a>
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
                      }
                        
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
    <div id="container"></div>
    <div id="pagination"></div>
</div>
@endsection
