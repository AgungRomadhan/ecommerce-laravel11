<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSales = FlashSale::with('product')->where('start_time', '<=', now())
            ->where('end_time', '>=', now())->get();

        return view('pages.user.flash-sale', compact('flashSales'));
    }
}