<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{



    public function getCategories($id)
    {
        $categories = Categoria::find($id)->products()->get();
        return $categories;
    }

}
