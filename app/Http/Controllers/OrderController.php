<?php

namespace App\Http\Controllers;

use App\Capacity;
use App\Order;
use App\Product;
use App\SingleOrder;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('orders.index')->with('orders', Order::orderBy('created_at', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('orders.create')
            ->with('products', Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function proceed(Request $request) {
        $my_arr = $request->get('products');
        $dups = $new_arr = array();
        foreach ($my_arr as $key => $val) {
            if (!isset($new_arr[$val])) {
                $new_arr[$val] = $key;
            } else {
                if (isset($dups[$val])) {
                    $dups[$val][] = $key;
                } else {
                    $dups[$val] = array($key);
                }
            }
        }

        $quantities = collect();
        $products = collect();
        $totalCapacity = 0.0;
        for ($i = 0; $i < count($request->input('quantity')); $i++) {
            $quantities->push($request->input('quantity')[$i]);
            $products->push(Product::find($request->input('products')[$i]));
            $totalCapacity += ($products[$i]->capacity * $quantities[$i]);
        }

        $totalCap = $totalCapacity;


        $readyBy = 0;
        $capacities = Capacity::whereRaw('capacities.left > 0')->orderBy('capacity_date', 'asc')->get();

        foreach ($capacities as $capacity) {
            $capacity = Capacity::find($capacity->id);
            $capDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($capacity->capacity_date)));

            if (!$capDate->isPast() || $capDate->isSameDay()) {
                if ($totalCapacity >= $capacity->left) {
                    $totalCapacity -= $capacity->left;
                    $capacity->left = 0;
                    $capacity->assigned = $capacity->total;
                } else {
                    $capacity->left -= $totalCapacity;
                    $capacity->assigned = $totalCapacity;
                    $totalCapacity = 0;
                }

                if ($totalCapacity == 0) {
                    $readyBy = $capacity->capacity_date;
                    break;
                }
            }
        }

        return view('orders.proceed')
            ->with('client', $request->input('client'))
            ->with('products', $products)
            ->with('totalCapacity', $totalCap)
            ->with('readyBy', $readyBy)
            ->with('quantities', $quantities)
            ->with('left', $this->computeLeft())
            ->with('capacities', Capacity::all())
            ->with('dups', $dups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $ids = $request->input('products');
        $quantities = $request->input('quantities');
        $totalCapacity = $request->input('totalCapacity');

        $order = new Order;
        $order->name = $request->input('client');
        $order->total_capacity = $request->input('totalCapacity');
        $order->ready_by = null;
        $order->save();

        for ($i = 0; $i < count($ids); $i++) {
            $singleOrder = new SingleOrder;
            $singleOrder->order_id = $order->id;
            $singleOrder->product_id = $ids[$i];
            $singleOrder->quantity = $quantities[$i];
            $singleOrder->save();

            $product = Product::find($ids[$i]);

            foreach ($product->stockToProducts as $item) {
                $stock = Stock::find($item->stock_id);
                $stock->stocks -= ($item->quantity * $quantities[$i]);
                $stock->save();
            }
        }

        $capacities = Capacity::whereRaw('capacities.left > 0')->orderBy('capacity_date', 'asc')->get();

        foreach ($capacities as $capacity) {
            $capacity = Capacity::find($capacity->id);
            $capDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($capacity->capacity_date)));

            if (!$capDate->isPast() || $capDate->isSameDay()) {
                if ($totalCapacity >= $capacity->left) {
                    $totalCapacity -= $capacity->left;
                    $capacity->left = 0;
                    $capacity->assigned = $capacity->total;
                } else {
                    $capacity->left -= $totalCapacity;
                    $capacity->assigned = $totalCapacity;
                    $totalCapacity = 0;
                }
                $capacity->save();

                if ($totalCapacity == 0) break;
            }
        }
        $order->ready_by = $capacity->capacity_date;
        $order->save();

        return redirect('/orders')->with('success', 'Order Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('orders.show')->with('order', Order::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $order = Order::find($id);
        foreach ($order->singleOrders as $item) $item->delete();
        $order->delete();

        return redirect('/orders')->with('success', 'Order Deleted Successfully!');
    }

    public function computeLeft() {
        $left = 0.0;
        foreach (Capacity::all() as $capacity) {
            $capDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($capacity->capacity_date)));
            if (!$capDate->isPast() || $capDate->isSameDay()) $left += $capacity->left;
        }

        return $left;
    }

    public function export($id) {
        $order = Order::find($id);
        $pdf = PDF::loadView('orders.export',
            compact('order'));
        return $pdf->stream($order->created_at.'.pdf');
    }
}
