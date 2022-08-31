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
        dame_repuesto(id_repuesto);
    
    

    function dame_repuesto(repuesto_id){
    let url = 'http://panchoserver.ddns.net/api/'+repuesto_id+'/repuesto';
    $.ajax({
        type:'get',
        url: url,
        beforeSend: function(){
            
          
        },
        success: function(data){
            console.log(data);
            let repuesto = data[0];
            let fotos = data[1];
            $('#titulo_repuesto').empty();
            $('#codigo_interno').empty();
            $('#stock_actual').empty();
            $('#precio').empty();
            
            $('#titulo_repuesto').append(repuesto.descripcion);
            $('#codigo_interno').append(repuesto.codigo_interno);
            $('#stock_actual').append(repuesto.stock_actual);
            $('#precio').append(repuesto.precio_venta);
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
            
        },
        error: function(error){
            console.log(error.responseText);
        }
    })
    
}
</script>
@endsection

@section('content')
    
<div class="container">
    <h2 id="titulo_repuesto"></h2>
    <div class="repuesto_tienda">
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
            <div class="col-md-6">
                <p>Descripción</p>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Código Interno</th>
                        <th scope="col">Stock actual</th>
                        <th scope="col">Precio</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row" id="codigo_interno"></th>
                        <td id="stock_actual"></td>
                        <td id="precio"></td>
                        <td><button class="btn btn-success btn-sm">Agregar</button></td>
                      </tr>
                      
                    </tbody>
                  </table>
            </div>
        </div>
        
    </div>
    
</div>
    
@endsection