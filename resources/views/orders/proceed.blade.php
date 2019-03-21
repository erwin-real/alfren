@extends('layouts.main')

@section('content')

    <style>
        /* Bootstrap 4 text input with search icon */

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
    </style>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
        <li class="breadcrumb-item"><a href="/orders/create">Create</a></li>
        <li class="breadcrumb-item active">Verify Order</li>
    </ol>
    <h3>Verify Order</h3>
    <hr>


    @if($left < $totalCapacity)
        <div class="alert alert-danger">
            Insufficient capacity. Kindly settle daily capacities first. <a href="/capacities">Click here</a>
        </div>
    @endif

    @if($dups)
        <div class="alert alert-danger">
            Cannot proceed due to duplicate orders.
        </div>
    @endif

    <span class="text-danger">* required</span>

    {!! Form::open(['action' => 'OrderController@store', 'method' => 'POST', 'class' => 'mt-4']) !!}
        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="client">Client's Name</label>  <span class="text-danger">*</span>
            <input type="text" class="form-control" name="client" required value="{{$client}}">
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="materialsTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Capacity (hours)</th>
                        <th>Quantity</th>
                        <th>Price/unit</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody id="materialsBody">
                        @for($i = 0; $i < count($products); $i++)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="products[]" required value="{{$products[$i]->id}}" hidden>
                                    <span>{{$products[$i]->name}}</span>
                                </td>
                                <td>
                                    <span>{{$products[$i]->description}}</span>
                                </td>
                                <td>
                                    <span>{{$products[$i]->capacity}}</span>
                                </td>
                                <td>
                                    <span>{{$quantities[$i]}}</span>
                                    <input type="text" class="form-control" name="quantities[]" required value="{{$quantities[$i]}}" hidden>
                                </td>
                                <td>
                                    <span>₱ {{number_format($prices[$i], 2, '.', ',')}}</span>
                                    <input type="text" class="form-control" name="prices[]" required value="{{$prices[$i]}}" hidden>
                                </td>
                                <td>
                                    <span>₱ {{number_format($subtotals[$i], 2, '.', ',')}}</span>
                                    <input type="text" class="form-control" name="subtotals[]" required value="{{$subtotals[$i]}}" hidden>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="name">Total Cost:</label>
                <span> <b> ₱ {{ number_format($total, 2, '.', ',') }}</b></span>
                {{--<input type="number" class="form-control" name="total" required value="{{ number_format($total, 2, '.', ',') }}" readonly>--}}
                <input type="hidden" class="form-control" name="total" required value="{{$total}}" readonly>
        </div>

        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="name">Total Capacity (hours): </label>
            <span> <b> {{ number_format($totalCapacity, 0, '.', ',') }}</b></span>
            <input type="hidden" class="form-control" name="totalCapacity" required value="{{$totalCapacity}}" readonly>
        </div>

        @if($left < $totalCapacity)
            <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
                <label for="name">Capacities left: </label>
                <span> <b> {{ number_format($left, 0, '.', ',') }}</b></span>
                <input type="hidden" class="form-control" value="{{$left}}" name="dateReady" required readonly>
            </div>
        @endif
        @if($left >= $totalCapacity && !$dups)
            <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
                <label for="name">Ready By: </label>
                <span> <b>{{date('D. M d, Y', strtotime($readyBy))}}</b></span>
                <input type="hidden" class="form-control" name="dateReady" value="{{date('D M d, Y', strtotime($readyBy))}}" required readonly>
            </div>

            <div class="form-group col-12">
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-user-check"></i> Submit</button>
                </div>
            </div>
        @endif
    {!! Form::close() !!}

    <a href="/orders/create" class="btn btn-outline-primary mt-4 mb-4 mx-2"><i class="fas fa-chevron-left"></i> Back</a>

@endsection