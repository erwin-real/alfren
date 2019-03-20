@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Bill of Materials</li>
    </ol>

    @include('includes.messages')

    <div class="row">

        <a href="/guides/products" target="_blank" class="btn btn-outline-info mt-1 mr-auto ml-3 mb-3"><i class="fas fa-info-circle"></i> Guide</a>
        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                <i class="fas fa-table"></i>
                Bill of Materials
                <a class="float-right" href="/products/create" style="text-decoration: none;"><i class="fas fa-plus"></i> Create</a>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Capacity (hours)</th>
                                <th>Show</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($products) > 0)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->capacity}}</td>
                                        <td><a href="/products/{{$product->id}}"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <th colspan="3">No products found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if(count($products) > 0)
                <div class="card-footer small text-muted">Last updated: {{date('D M d, Y h:i A', strtotime($products[0]->updated_at))}}</div>
            @endif
            {{--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>--}}
            </div>
        </div>

    </div>

@endsection