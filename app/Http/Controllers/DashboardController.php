<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        return view('dashboard')
            ->with("orders", Order::orderBy('updated_at', 'desc')->get())
            ->with("stocks", Stock::orderBy('updated_at', 'desc')->get())
            ->with("products", Product::orderBy('updated_at', 'desc')->get());
//            ->with('safetyStocks', count(Stock::whereRaw('stocks.stocks <= stocks.procurement')->get()));
    }
}
