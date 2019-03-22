@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">{{count($stocks)}} Raw Material(s) !</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/stocks">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-cube"></i>
                    </div>
                    <div class="mr-5">{{count($products)}} Bill of Material(s) !</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/products">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">{{count($orders)}} Order(s) !</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/orders">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        {{--<div class="col-xl-3 col-sm-6 mb-3">--}}
            {{--<div class="card text-white bg-danger o-hidden h-100">--}}
                {{--<div class="card-body">--}}
                    {{--<div class="card-body-icon">--}}
                        {{--<i class="fas fa-fw fa-exclamation-triangle"></i>--}}
                    {{--</div>--}}
                    {{--<div class="mr-5">{{$safetyStocks}} Material(s) for Procurement !</div>--}}
                {{--</div>--}}
                {{--<a class="card-footer text-white clearfix small z-1" href="/safety_stocks">--}}
                    {{--<span class="float-left">View Details</span>--}}
                    {{--<span class="float-right">--}}
                    {{--<i class="fas fa-angle-right"></i>--}}
                  {{--</span>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Orders Overview
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Client's Name</th>
                                    <th>Date</th>
                                    <th>Ready by</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders) > 0)
                                    @for ($i = 0; ($i < 5 && $i < count($orders)); $i++)
                                        <tr>
                                            <td>{{$orders[$i]->name}}</td>
                                            <td>{{date('D M d, Y h:i a', strtotime($orders[$i]->created_at))}}</td>
                                            <td>{{date('D M d, Y', strtotime($orders[$i]->ready_by))}}</td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr class="text-center">
                                        <th colspan="3">No orders found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Raw Materials Overview
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>On hand</th>
                                    <th>Safety Stock</th>
                                    <th>Reorder Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($stocks) > 0)
                                    @for ($i = 0; ($i < 5 && $i < count($stocks)); $i++)
                                        <tr class="{{(((($stocks[$i]->demand*4) / 31)*2) + ((((($stocks[$i]->demand*4) / 31) * .1) + (($stocks[$i]->demand*4) / 31)) * 4) - ((($stocks[$i]->demand*4) / 31)*2)) >= $stocks[$i]->stocks ? 'bg-warning' : ''}}">
                                            <td>{{$stocks[$i]->name}}</td>
                                            <td>{{$stocks[$i]->category}}</td>
                                            <td class="{{($stocks[$i]->stocks <= 0) ? "text-danger font-weight-bold" : ""}}">{{$stocks[$i]->stocks}}</td>
                                            <td>{{ ceil((((((($stocks[$i]->demand*4) / 31) * .1) + (($stocks[$i]->demand*4) / 31)) * 4) - ((($stocks[$i]->demand*4) / 31)*2))) }}</td>
                                            <td>{{ ceil((((($stocks[$i]->demand*4) / 31)*2) + ((((($stocks[$i]->demand*4) / 31) * .1) + (($stocks[$i]->demand*4) / 31)) * 4) - ((($stocks[$i]->demand*4) / 31)*2))) }}</td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr class="text-center">
                                        <th colspan="3">No stocks found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Bill of Materials Overview
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Capacity (hours)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($products) > 0)
                                    @for ($i = 0; ($i < 5 && $i < count($products)); $i++)
                                        <tr>
                                            <td>{{$products[$i]->name}}</td>
                                            <td>{{$products[$i]->description}}</td>
                                            <td>{{$products[$i]->capacity}}</td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr class="text-center">
                                        <th colspan="3">No products found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection