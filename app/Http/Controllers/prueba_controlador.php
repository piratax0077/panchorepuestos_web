<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class prueba_controlador extends Controller
{
    public function index()
    {
        return view('prueba');
    }

    public function repuestos(){
        return view('repuestos');
    }

    public function contacto(){
        return view('contacto');
    }

    public function repuesto($id){
        return view('repuesto',['repuesto_id' => $id]);
    }

    public function busqueda_por_modelo($modelo,$familia){
        return view('busqueda_por_modelo',['idmodelo' => $modelo,'familia' => $familia]);
    }

    public function busqueda_por_oem($oem){
        return view('busqueda_por_oem',['oem' => $oem]);
    }
}
