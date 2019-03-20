@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Orders</li>
    </ol>

    @include('includes.messages')

    <div class="row">

        <a href="/guides/orders" target="_blank" class="btn btn-outline-info mt-1 mr-auto ml-3 mb-3"><i class="fas fa-info-circle"></i> Guide</a>
        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                    <a class="float-right" href="/orders/create" style="text-decoration: none;"><i class="fas fa-plus"></i> New</a>
                </div>
                <div class="card-body">

                    @if(count($orders))
                        @foreach($orders as $order)
                            <div class="alert" style="border-color: #0c5460" role="alert">
                                <div class="row">

                                    <div class="col-sm-12 col-md-4">
                                        <p><b>Client's Name</b>: <br>&nbsp;&nbsp; {{$order->name}}</p>
                                        <p><b>Date Created</b>: <br>&nbsp;&nbsp; {{date('D M d, Y', strtotime($order->created_at))}}</p>
                                        <p><b>Ready By</b>: <br>&nbsp;&nbsp; {{date('D M d, Y', strtotime($order->ready_by))}}</p>
                                        <p><a href="/orders/{{$order->id}}" class="btn btn-outline-info"><i class="fa fa-eye"></i> Show</a></p>
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
                            </div>
                        @endforeach
                    @else
                        <h3>No orders yet...</h3>
                    @endif


                </div>
            </div>
        </div>

    </div>

@endsection