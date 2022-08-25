@extends('layouts.app')

@section('javascript')
<script>
    var URLactual = window.location;
    alert(URLactual);
</script>
@endsection

@section('content')
    {{$repuesto_id}}
@endsection