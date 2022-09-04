@extends('layouts.app')

@section('javascript')
<script>

        //Se recupera la url actual
        var URLactual = window.location;
        //Convertimos la url a string para poder rescatar el id del repuesto
        var strurl = String(URLactual);
        //Separamos el string y dejamos solo el id
        var id_array = strurl.split('/');
        var modelo = id_array[4];
        var familia = id_array[5];
    
        busqueda_principal(modelo);

        function busqueda_principal(modelo){

            let url = 'http://panchoserver.ddns.net/api/buscar_modelo/'+modelo+'/'+familia;
            
            $.ajax({
                type:'get',
                url: url,
                beforeSend: function(){
                    
                },
                success: function(repuestos){
                        
                        let fotos = repuestos[1];
                        if(repuestos[0].length == 0){
                            
                            $('#container').empty();
                            $('#container').append('<p class="alert-danger">Sin resultados</p>');
                        }else{
                            let container = $('#pagination');
                        var contador = 0;
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
            })
        }
</script>
@endsection

@section('content')

<p id="mensaje"></p>
<section class="container py-5">

<div id="container"></div>
<div id="pagination"></div> 
    
</section>
@endsection