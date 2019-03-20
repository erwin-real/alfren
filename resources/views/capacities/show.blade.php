@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/capacities">Daily Capacities</a></li>
        <li class="breadcrumb-item active">{{date('D M d, Y', strtotime($capacity->capacity_date))}}</li>
    </ol>

    <div class="button-holder text-right">
        <a href="/capacities/{{$capacity->id}}/edit" class="btn btn-outline-primary mt-1"><i class="fas fa-pencil-alt"></i> Edit</a>
        @if($delete)
            <a class="btn btn-outline-danger mt-1" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>
        @endif
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="col-sm-12 col-md-4">
                <p><b>Date</b>: <br>&nbsp;&nbsp; {{date('D M d, Y', strtotime($capacity->capacity_date))}}</p>
                <p><b>Total</b>: <br>&nbsp;&nbsp; {{$capacity->total}} hours</p>
                <p><b>Assigned</b>: <br>&nbsp;&nbsp; {{$capacity->assigned}} hours</p>
                <p><b>Left</b>: <br>&nbsp;&nbsp; {{$capacity->left}} hours</p>
                <p><b>Created at</b>: <br>&nbsp;&nbsp; {{date('D M d, Y h:i A', strtotime($capacity->created_at))}}</p>
                <p><b>Updated at</b>: <br>&nbsp;&nbsp; {{date('D M d, Y h:i A', strtotime($capacity->updated_at))}}</p>
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
                <div class="modal-body">Select "Delete" below if you really want to delete the specific capacity date.</div>
                <div class="modal-footer">

                    <button class="btn btn-outline-secondary mt-1" type="button" data-dismiss="modal">Cancel</button>

                    <form id="delete" method="POST" action="{{ action('CapacityController@destroy', $capacity->id) }}" class="float-right mt-1 ml-1">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection