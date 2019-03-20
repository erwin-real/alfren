<?php

namespace App\Http\Controllers;

use App\Product;
use App\Stock;
use App\StockToProduct;
use Illuminate\Http\Request;
use function PHPSTORM_META\elementType;

class ProductController extends Controller
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
        return view('products.index')
            ->with("products", Product::orderBy('updated_at', 'asc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('products.create')->with("stocks", Stock::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $my_arr = $request->get('stocks');
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
        if ($dups) return redirect('/products')->with('error', 'Cannot create the product because it has duplicate raw materials!');

        $product = new Product;
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->capacity = $request->get('capacity');
        $product->save();

        for ($i = 0; $i < count($request->get('stocks')); $i++) {
            $stockToProduct = new StockToProduct;
            $stockToProduct->product_id = $product->id;
            $stockToProduct->stock_id = $request->get('stocks')[$i];
            $stockToProduct->quantity = $request->get('number')[$i];
            $stockToProduct->save();
        }

        return redirect('/products')->with('success', 'Product Created Successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('products.show')->with('product', Product::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('products.edit')
            ->with('product', Product::find($id))
            ->with('stocks', Stock::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->capacity = $request->get('capacity');
        $product->save();

        foreach ($product->stockToProducts as $stockToProduct) $stockToProduct->delete();

        for ($i = 0; $i < count($request->get('stocks')); $i++) {
            $stockToProduct = new StockToProduct;
            $stockToProduct->product_id = $product->id;
            $stockToProduct->stock_id = $request->get('stocks')[$i];
            $stockToProduct->quantity = $request->get('number')[$i];
            $stockToProduct->save();
        }

        return redirect('/products')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Product::find($id);
        foreach ($product->stockToProducts as $stockToProduct) $stockToProduct->delete();
        $product->delete();

        return redirect('/products')->with('success', 'Product Deleted Successfully!');
    }
}
