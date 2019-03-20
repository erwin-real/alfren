@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
        <li class="breadcrumb-item active">{{$order->name}}</li>
    </ol>

    <div class="button-holder text-right">
        {{--<a href="/stocks/{{$stock->id}}/edit" class="btn btn-outline-primary mt-1"><i class="fas fa-pencil-alt"></i> Edit</a>--}}
        <a class="btn btn-outline-danger mt-1" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>
    </div>

    <div class="row mt-4">
        <div class="col-sm-12 col-md-3 ml-4">
            <p><b>Client's Name</b>: <br>&nbsp;&nbsp; {{$order->name}}</p>
            <p><b>Date Created</b>: <br>&nbsp;&nbsp; {{date('D M d, Y', strtotime($order->created_at))}}</p>
            <p><b>Ready By</b>: <br>&nbsp;&nbsp; {{date('D M d, Y', strtotime($order->ready_by))}}</p>

            <div class="w-100 text-center mb-4">
                <a href="/orders/export/{{$order->id}}" target="_blank" class="btn btn-outline-success"><i class="fa fa-file-invoice"></i> EXPORT</a>
            </div>
        </div>

        <div class="col-sm-12 col-md-8">
            <div class="col-12 mb-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Products
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->singleOrders as $item)
                                    <tr>
                                        <td>{{$item->product['name']}}</td>
                                        <td>{{$item->product['description']}}</td>
                                        <td>{{$item->quantity}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

                    <form id="delete" method="POST" action="{{ action('OrderController@destroy', $order->id) }}" class="float-right mt-1 ml-1">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection