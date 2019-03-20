@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Daily Capacities</li>
    </ol>

    @include('includes.messages')

    <div class="row">

        <a href="/guides/capacities" target="_blank" class="btn btn-outline-info mt-1 mr-auto ml-3 mb-3"><i class="fas fa-info-circle"></i> Guide</a>
        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i> Daily Capacities
                    <a class="float-right" href="/capacities/create" style="text-decoration: none;"><i class="fas fa-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    Total hours left: <b class="{{$left <= 0 ? "text-danger" : ""}}">{{$left}}</b>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total (hours)</th>
                                    <th>Assigned (hours)</th>
                                    <th>Left (hours)</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($capacities) > 0)
                                    @foreach($capacities as $capacity)
                                        <tr>
                                            <td>{{date('D M d, Y', strtotime($capacity->capacity_date))}}</td>
                                            <td>{{$capacity->total}}</td>
                                            <td>{{$capacity->assigned}}</td>
                                            <td>{{$capacity->left}}</td>
                                            <td><a href="/capacities/{{$capacity->id}}"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <th colspan="5">No capacities found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($capacities) > 0)
                    <div class="card-footer small text-muted">Last updated: {{date('D M d, Y h:i A', strtotime($capacities[0]->updated_at))}}</div>
                @endif
            </div>
        </div>

    </div>

@endsection