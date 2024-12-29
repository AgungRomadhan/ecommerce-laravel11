<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('pages.admin.flash-sale.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discounted_price' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        FlashSale::create($request->all());

        return redirect()->route('flash-sale.create')->with('success', 'Flash Sale berhasil ditambahkan!');
    }
}