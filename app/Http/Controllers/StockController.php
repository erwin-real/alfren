<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
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
        return view('stocks.index')
            ->with("stocks", Stock::orderBy('updated_at', 'desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stocks' => 'required',
            'unit' => 'required',
            'demand' => 'required'
        ]);


        $stock = Stock::firstOrNew([
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'description' => $validatedData['description'],
            'unit' => $validatedData['unit'],
            'demand' => $validatedData['demand']
        ]);
        $stock->unit = $validatedData['unit'];
        if ($stock->stocks) return redirect('/stocks')->with('error', 'Raw Material is already in records.');

        $stock->stocks = $request->input('stocks');
//        $stock->procurement = $request->input('procurement');
        $stock->save();

        return redirect('/stocks')->with('success', 'Raw Material Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('stocks.show')->with('stock', Stock::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('stocks.edit')->with('stock', Stock::find($id));
    }

    /**
     * Update the specified resource in storage.
     *o
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stocks' => 'required',
            'unit' => 'required',
            'demand' => 'required'
        ]);

        $stock = Stock::find($id);
        $stock->name = $validatedData['name'];
        $stock->category = $validatedData['category'];
        $stock->description = $validatedData['description'];
        $stock->stocks = $validatedData['stocks'];
        $stock->unit = $validatedData['unit'];
        $stock->demand = $validatedData['demand'];
//        $stock->procurement = $request->input('procurement');
        $stock->save();

        return redirect('/stocks')->with('success', 'Raw Material Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $stock = Stock::find($id);
        $stock->delete();
        return redirect('/stocks')->with('success', 'Raw Material Deleted Successfully');
    }

//    public function safetyStocks() {
//        return view('safety_stocks.index')
//            ->with('stocks', Stock::orderBy('updated_at', 'desc')->whereRaw('stocks.stocks <= stocks.procurement')->get());
//    }
}
