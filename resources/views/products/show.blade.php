@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/products">Bill of Materials</a></li>
        <li class="breadcrumb-item active">{{$product->name}}</li>
    </ol>

    <div class="button-holder text-right">
        <a href="/products/{{$product->id}}/edit" class="btn btn-outline-primary mt-1"><i class="fas fa-pencil-alt"></i> Edit</a>
        <a class="btn btn-outline-danger mt-1" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>
    </div>

    <div class="row">

        <div class="col-12 mb-3">

            <h3>Product's Details</h3>
            <hr>

            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p><b>Name</b>: <br>&nbsp;&nbsp; {{$product->name}}</p>
                    <p><b>Description</b>: <br>&nbsp;&nbsp; {{$product->description}}</p>
                    <p><b>Capacity</b>: <br>&nbsp;&nbsp; {{$product->capacity}}</p>
                    <p><b>Created at</b>: <br>&nbsp;&nbsp; {{date('D M d, Y h:i A', strtotime($product->created_at))}}</p>
                    <p><b>Updated at</b>: <br>&nbsp;&nbsp; {{date('D M d, Y h:i A', strtotime($product->updated_at))}}</p>
                </div>

                <div class="col-sm-12 col-md-8">
                    <div class="col-12 mb-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Materials Needed
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Raw Material</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product->stockToProducts as $stockToProduct)
                                                <tr>
                                                    <td>{{$stockToProduct->stock['name']}}</td>
                                                    <td>{{$stockToProduct->stock['category']}}</td>
                                                    <td>{{$stockToProduct->stock['description']}}</td>
                                                    <td>{{$stockToProduct->quantity}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Last updated: {{date('D M d, Y h:i A', strtotime($product->updated_at))}}</div>
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
                <div class="modal-body">Select "Delete" below if you really want to delete the product.</div>
                <div class="modal-footer">

                    <button class="btn btn-outline-secondary mt-1" type="button" data-dismiss="modal">Cancel</button>

                    <form id="delete" method="POST" action="{{ action('ProductController@destroy', $product->id) }}" class="float-right mt-1 ml-1">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection