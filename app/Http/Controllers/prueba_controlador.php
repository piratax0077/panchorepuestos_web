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
}
