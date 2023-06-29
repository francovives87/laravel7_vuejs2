<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class MainController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            $id = Auth::id();
            $user = User::find($id);
            $hasTienda = $user->tienda()->count();

            if ($hasTienda > 0) {
            
            }

            return view('main')
                ->with('id', $id)
                ->with('hasTienda', $hasTienda);
        }


        return view('main');
    }
}
