
@extends('layouts.app')

@section('javascript')
<script>
      $( function() {
    $( "#accordion" ).accordion();
  } );
</script>
@endsection

@section('content')
@include('fragm.slider')
@include('fragm.buscador')
            @include('fragm.banner')
            @include('fragm.banner2')
            @include('fragm.banner3')
@endsection

