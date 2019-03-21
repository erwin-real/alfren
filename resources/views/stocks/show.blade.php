@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/stocks">Inventory</a></li>
        <li class="breadcrumb-item active">{{$stock->name}}</li>
    </ol>

    <div class="button-holder text-right">
        <a href="/stocks/{{$stock->id}}/edit" class="btn btn-outline-primary mt-1"><i class="fas fa-pencil-alt"></i> Edit</a>
        <a class="btn btn-outline-danger mt-1" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>
    </div>

    <div class="row">

        <div class="col-12 mb-3">

            <h3>Material's Details</h3>
            <hr>
            @if((((($stock->demand*4) / 31)*2) + ((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2)) >= $stock->stocks)
                <div class="alert alert-danger">
                    <p class="font-weight-bold">THIS MATERIAL NEEDS TO REORDER.</p>
                    <p><b>On hand</b>: {{$stock->stocks}}</p>
                    <p><b>Safety Stock</b>: {{ ceil((((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2))) }}</p>
                    <p><b>Reorder Point</b>: {{ ceil((((($stock->demand*4) / 31)*2) + ((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2))) }}</p>
                </div>
            @endif

            <div class="col-12">
                <p><b>Name</b>: {{$stock->name}}</p>
                <p><b>Category</b>: {{$stock->category}}</p>
                <p><b>Description</b>: {{$stock->description}}</p>
                <p><b>On hand</b>: {{$stock->stocks}}</p>
                {{--<p><b>Demand</b>: {{$stock->demand}}</p>--}}
                <p><b>Unit</b>: {{$stock->unit}}</p>
                <hr>
{{--                <p><b>Average Daily</b>: {{ number_format((($stock->demand*4) / 31), 2, '.', ',') }}</p>--}}
{{--                <p><b>Lead Time</b>: {{ number_format(((($stock->demand*4) / 31)*2), 2, '.', ',') }}</p>--}}
{{--                <p><b>Maximum Daily</b>: {{ number_format((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)), 2, '.', ',') }}</p>--}}
                <p><b>Safety Stock</b>: {{ ceil((((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2))) }}</p>
                <p><b>Reorder Point</b>: {{ ceil((((($stock->demand*4) / 31)*2) + ((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2))) }}</p>
                <hr>
                <p><b>Created at</b>: {{date('D M d, Y h:i A', strtotime($stock->created_at))}}</p>
                <p><b>Updated at</b>: {{date('D M d, Y h:i A', strtotime($stock->updated_at))}}</p>
            </div>

        </div>

    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you really want to delete the raw material.</div>
                <div class="modal-footer">

                    <button class="btn btn-outline-secondary mt-1" type="button" data-dismiss="modal">Cancel</button>

                    <form id="delete" method="POST" action="{{ action('StockController@destroy', $stock->id) }}" class="float-right mt-1 ml-1">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection