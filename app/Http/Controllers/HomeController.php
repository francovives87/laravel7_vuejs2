<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use App\Tienda;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        

        $userId = Auth::id();

        $tienda = User::find($userId)->tienda()->get();

        return view('home')
        ->with('tienda',$tienda);

    }

    public function categoriaViews()
    {
        return view('home.createcategoria');
    }


}
