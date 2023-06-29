<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Tienda;

class HomeTiendaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

   public function GetTiendaDelUser($id)
   {

    $getTiendaDelUser = User::find($id)->tienda()->get();

    return $getTiendaDelUser;
      
   }


}
