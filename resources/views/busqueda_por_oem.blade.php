@extends('layouts.app')
@section('javascript')
<script>

    //Se recupera la url actual
    var URLactual = window.location;
        //Convertimos la url a string para poder rescatar el id 
        var strurl = String(URLactual);
        //Separamos el string y dejamos solo el id
        var id_array = strurl.split('/');
        var oem = id_array[4];

    buscar_por_oem(oem);

    function buscar_por_oem(oem){
        
        let url = 'http://panchoserver.ddns.net/api/buscar_por_oem/'+oem;
            
            $.ajax({
                type:'get',
                url: url,
                success: function(repuestos){
                        
                        let contador = 0;
                        let fotos = repuestos[1];
                        if(repuestos[0].length == 0){
                            $('#container').html('<p class="alert-danger">Sin resultados </p>');
                        }else{
                            let container = $('#pagination');
                        container.pagination({
                            dataSource: repuestos[0],
                            pageSize: 10,
                            callback: function (data, pagination) {
                                var dataHtml = '<div class="row w-100">';
                                    if(fotos[contador].urlfoto !== null){
                                        $.each(data, function (index, item) {
                                        dataHtml += `
                                        <div class="col-md-3 mb-3">
                                        <div class="card">
                                        <img class="card-img-top repuestos_image"  src="http://panchoserver.ddns.net/storage/`+fotos[contador].urlfoto+`" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">`+item.descripcion+`</h5>
                                            <p class="card-text">$ `+item.precio_venta+`</p>
                                            <p class="card-text">Stock: `+item.stock_actual+`</p>
                                            
                                            <a href="/repuesto/`+item.id+`" class="btn btn-warning w-100">Descripción</a>
                                        </div>
                                        </div>
                                    </div>
                                    `;
                                    contador++;
                                });
                                    }
                                

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
    <h1>Repuestos</h1>
    <div id="container"></div>
    <div id="pagination"></div>
</div>

@endsection