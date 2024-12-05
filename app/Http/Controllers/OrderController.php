<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oders as Order;
use App\Models\User;
use App\Models\product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::inRandomOrder()->limit(8)->get();
        $users = User::all();
        $products = product::all();
        return view('pages.order', [
            'orders' => $orders,
            'users' => $users,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        Order::create([
            'name' => $request->name,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => Order::STATUS['PENDING'],
            'total' => $request->total,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()->route('orders')->with('success', 'Order created successfully.');
    }
}
