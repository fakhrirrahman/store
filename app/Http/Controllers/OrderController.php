<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oders;

class OrderController extends Controller
{
    public function index()
    {
        $order = Oders::inRandomOrder()->limit(8)->get();
        return view('pages.order', [
            'order' => $order
        ]);
    }
}
