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
        var idmarca = id_array[4];
        cargar_Modelos(idmarca);
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
        $('#mensaje').empty();
        $('#mensaje').append('<img src="{{asset("assets/images/loading6.gif")}}" alt="Cargando ...">');
      },
      url:url_buscar,
      success:function(modelos){
        $('#mensaje').html('LISTO');
        console.log(modelos);
        let container = $('#pagination');
                        container.pagination({
                            dataSource: modelos,
                            pageSize: 12,
                            callback: function (data, pagination) {
                                var dataHtml = '<div class="row w-100">';

                                $.each(data, function (index, item) {
                                    
                                    dataHtml += `
                                    <div class="col-md-3 mb-3">
                                    <div class="card">
                                    <img class="card-img-top repuestos_image"  src="http://panchoserver.ddns.net/storage/`+item.urlfoto+`" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-title"> <a href="/repuestos_modelo/`+item.id+`" class="a_modelo" >`+item.modelonombre+`</a></h6>
                                        
                                    </div>
                                    </div>
                                    </div>
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