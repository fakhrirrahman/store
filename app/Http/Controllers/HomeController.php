<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $product = product::inRandomOrder()->limit(8)->get();
        return view('pages.home', [
            'product' => $product
        ]);
    }
}
