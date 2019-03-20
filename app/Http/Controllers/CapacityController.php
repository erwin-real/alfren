<?php

namespace App\Http\Controllers;

use App\Capacity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CapacityController extends Controller
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
        $capacities = Capacity::orderBy('capacity_date', 'desc')->get();

        return view('capacities.index')
            ->with('capacities', $capacities)
            ->with('left', $this->computeLeft());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('capacities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            'capDate' => 'required',
            'total' => 'required'
        ]);

        $capDate = Carbon::createFromFormat('Y-m-d', $request->input('capDate'));

        foreach (Capacity::all() as $capacity) {
            if (date('Y-m-d', strtotime($capacity->capacity_date)) == $request->input('capDate'))
                return redirect('/capacities')->with('error', date('D M d, Y', strtotime($capacity->capacity_date)).' was assigned already!');
        }

        if ($capDate->isPast() && !$capDate->isSameDay())
            return redirect('/capacities')->with('error', date('D M d, Y', strtotime($capDate)).' cannot be assigned because it\'s past already!');

        if ($capDate->isSunday())
            return redirect('/capacities')->with('error', date('D M d, Y', strtotime($capDate)).' cannot be assigned because it\'s Sunday!');


        $capacity = new Capacity;
        $capacity->capacity_date = $request->input('capDate');
        $capacity->total = $request->input('total');
        $capacity->assigned = 0;
        $capacity->left = $request->input('total');
        $capacity->save();

        return redirect('/capacities')->with('success', 'New Daily Capacity Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $capacity = Capacity::find($id);
        $capDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($capacity->capacity_date)));
        $delete = false;

        if ($capDate->isPast() && !$capDate->isSameDay()) $delete = true;

        return view('capacities.show')
            ->with('capacity', $capacity)
            ->with('delete', $delete);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('capacities.edit')->with('capacity', Capacity::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'total' => 'required'
        ]);

        $capacity = Capacity::find($id);
        $capacity->total = $request->input('total');
        $capacity->left = $request->input('total') - $capacity->assigned;
        $capacity->save();

        return redirect('/capacities')->with('success', 'New Daily Capacity Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $capacity = Capacity::find($id);
        $capacity->delete();

        return redirect('/capacities')->with('success', 'Daily Capacity Deleted Successfully!');
    }

    public function computeLeft() {
        $left = 0.0;
        foreach (Capacity::all() as $capacity) {
            $capDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($capacity->capacity_date)));
            if (!$capDate->isPast() || $capDate->isSameDay()) $left += $capacity->left;
        }

        return $left;
    }
}
