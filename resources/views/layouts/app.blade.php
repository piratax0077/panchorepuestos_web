<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PanchoRepuestos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        @yield('javascript')
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
      
        <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script>
            function revisar_carrito(){
                $.ajax({
                    type:'get',
                    url: '/revisar_carrito',
                    success: function(cantidad){
                        if(cantidad == 0){
                            $('#cantidad_items').empty();
                        }else{
                            $('#cantidad_items').empty();
                            $('#cantidad_items').append(cantidad);
                        }
                        
                    },
                    error: function(error){
                        console.log(error.responseText);
                    }
                })
            }

            function buscar(){
                let valor = $('#tags').val();
                alert(valor);
            }

            revisar_carrito();
        </script>
    </head>
    <body>
        @include('fragm.header')
        
        <div class="main">
            @yield('content')
            
        </div>
        @include('fragm.footer')
        
        <a href="https://api.whatsapp.com/send?phone=56997158871" class="btn_contacto_whatsapp" style="text-decoration: none;" title="We ask for your age only for statistical purposes."><img src="{{asset("assets/images/probleme-notifications-whatsapp4.png")}}" alt="wzap" style="width: 80px;"></a>
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
