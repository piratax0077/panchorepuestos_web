@extends('layouts.app')

@section('javascript')
<script>

</script>
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <span style="font-weight: bold;">Bienvenidos a </span> <span>PanchoRepuestos</span>
    </div>
    
    <article>Somos Juana y Jose, madre e hijo, y hace 10 años, después de pasar por otros rubros comerciales, decidimos formar panchorepuestos, una empresa que se dedica a la venta de repuestos automotrices. 
        Desde el día que tomamos dicha decisión, hemos trabajado en ofrecer a nuestros clientes, productos que sean de calidad y a la vez a bajo costo, con 
        una atención personalizada en nuestro local, orientada a que tengan la mejor experiencia de compra. En estos momentos, tenemos a disposición de nuestros un amplio 
        catalogo de repuestos para las variadas marcas y modelos de vehículos que existen en el mercado.</article>
        <div class="row mt-5 pb-5">
            <div class="col-md-6">
                <p>¿Quienes somos?</p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('assets/images/bodega1.jpeg')}}" class="image_quienes_somos" alt="">
                    </div>
                    <div class="col-md-6">
                        <span>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment.</span>
                    </div>
                </div>
                
               
            </div>
            <div class="col-md-6">
                <p>Nuestra misión</p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('assets/images/bodega2.jpeg')}}" class="image_quienes_somos" alt="">
                    </div>
                    <div class="col-md-6">
                        <span>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment.</span>
                    </div>
                </div>
                
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>¿Qué hacemos?</p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('assets/images/bodega3.jpeg')}}" class="image_quienes_somos" alt="">
                    </div>
                    <div class="col-md-6">
                        <span>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment.</span>
                    </div>
                </div>
                
                
            </div>
            <div class="col-md-6">
                <p>Nuestra visión</p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('assets/images/bodega4.jpeg')}}" class="image_quienes_somos" alt="">
                    </div>
                    <div class="col-md-6">
                        <span>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment.</span>
                    </div>
                </div>
                
            </div>
        </div>
</div>


@endsection