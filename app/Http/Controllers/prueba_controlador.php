<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\carrito_compras;
use Illuminate\Support\Facades\Auth;

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

    public function damemarcas(){
        return view('marcas');
    }

    public function agregar_carrito(Request $req){
        $items = $this->dame_carrito_actual();
        foreach($items as $item){
            if($item->repuestos_id == $req->id_repuesto){
                return 'error';
            }
        }
        try {
            $usuario = Auth::user();
            $carrito = new carrito_compras;
            $carrito->repuestos_id = $req->id_repuesto;
            $carrito->usuario_id = $usuario->id;
            $carrito->item = 1;
            $carrito->cantidad = $req->cantidad;
            $carrito->precio_neto = $req->precio_neto;
            $carrito->save();
            return 'OK';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function carrito(){
        $items = $this->dame_carrito_actual();
        return view('carrito',['items' => $items]);
    }

    public function revisar_carrito(){
        if(Auth::user()){
            $carrito = $this->dame_carrito_actual();
            return $carrito->count();
        }else{}
        
    }

    private function dame_carrito_actual(){
        try {
            $items = carrito_compras::where('usuario_id',Auth::user()->id)->get();
            return $items;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function eliminar_item_carrito(Request $req){
        
        try {
            $item = carrito_compras::where('repuestos_id',$req->idrep)->where('usuario_id',$req->user_id)->first();
            $item->delete();
           
            $items = $this->dame_carrito_actual();
            return $items->count();
        } catch (\Exception $e) {
            
        }
    }

    public function modelos_marca($idmarca){
        return view('modelos_marca',['idmarca' => $idmarca]);
    }

    public function repuestos_modelo($idmodelo){
        return view('repuestos_modelo',['idmodelo' => $idmodelo]);
    }

    public function quienes_somos(){
        return view('quienes-somos');
    }
}
