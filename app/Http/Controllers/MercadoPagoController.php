<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPagoController extends Controller
{
    public function index()
    {
        return view('mp');
    }

    public function payment(Request $request)
    {
        /*         $mp_access_token = $request->mp_access_token; */
        $data = $request->data;
        $data= $data->nombre;
        

    /*     foreach ($carts as $cart) {
            $res = array_push($res,$cart->nombre);
        }
        */

        /*     SDK::setAccessToken($mp_access_token);


        // Crea un objeto de preferencia
        $preference = new Preference();

        // Crea un ítem en la preferencia
        $item = new Item();

        $item->id = '1234';
        $item->title = 'hola';
        $item->quantity = 1;
        $item->unit_price = 100.00;
        $item->description = 'hola';

        //Creo un objeto de pagador
        $payer = new Payer();

data_array
        $payer->phone = [
            'area_code' => '11',
            'numbre' => '222233333',
        ];

        $payer->address = [
            'street_name' => 'False',
            'street_number' => '123',
            'zip_code' => '1111',
        ];


        $preference->items = array($item);
        


        $preference->save(); 

         return $preference->init_point; */
        return var_dump($data);
    }
}
