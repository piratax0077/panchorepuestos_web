<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\compra_transbank;

class transbank_controlador extends Controller
{
    public function __construct(){
        if( app()->environment('production')){
            WebpayPLus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function index(Request $request){
        
        $nueva_compra = new compra_transbank;
        $nueva_compra->session_id = "123456";
        $nueva_compra->total = $request->total;
        $nueva_compra->status = 1;
        $nueva_compra->save();
        $url_to_pay = self::start_web_pay_plus_transaction($nueva_compra);
        return $url_to_pay;
    }

    public function start_web_pay_plus_transaction($nueva_compra){
        $transaccion = (new Transaction)->create(
            $nueva_compra->id,
            $nueva_compra->session_id,
            $nueva_compra->total,
            route('confirmar_pago')
        );
        $url = $transaccion->getUrl().'?token_ws='.$transaccion->getToken();
        return $url;
    }

    public function confirmar_pago(Request $req){
        $confirmacion = (new Transaction)->commit($req->get('token_ws'));

        if($confirmacion->isApproved()){
            $compra->status = 2; // Aprobada
            $compra->update();

            return redirect('confirmacion_pago'."?compra_id={$compra->id}");
        }else{
            //fallida o rechazada
            return redirect('confirmacion_pago'."?compra_id={$compra->id}");
        }
    }
}
