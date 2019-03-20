<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function stocks() {
        return view('guides.stocks');
    }

    public function products() {
        return view('guides.products');
    }

    public function orders() {
        return view('guides.orders');
    }

    public function capacities() {
        return view('guides.capacities');
    }
}
