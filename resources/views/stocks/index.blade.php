@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Inventory</li>
    </ol>

    @include('includes.messages')

    <div class="row">

        <a href="/guides/stocks" target="_blank" class="btn btn-outline-info mt-1 mr-auto ml-3 mb-3"><i class="fas fa-info-circle"></i> Guide</a>
        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Raw Materials

                    <a class="float-right" href="/stocks/create" style="text-decoration: none;"><i class="fas fa-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>On hand</th>
                                    {{--<th>Demand</th>--}}
                                    <th>Unit</th>
                                    {{--<th>Average Daily</th>--}}
                                    {{--<th>Lead time</th>--}}
                                    {{--<th>Maximum Daily</th>--}}
                                    <th>Safety Stock</th>
                                    <th>Reorder Point</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($stocks) > 0)
                                    @foreach($stocks as $stock)
                                        <tr class="{{(((($stock->demand*4) / 31)*2) + ((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2)) >= $stock->stocks ? 'bg-warning' : ''}}">
                                            <td>{{$stock->name}}</td>
                                            <td>{{$stock->category}}</td>
                                            <td>{{$stock->description}}</td>
                                            <td class="{{($stock->stocks <= 0) ? "text-danger font-weight-bold" : ""}}">{{$stock->stocks}}</td>
                                            {{--<td>{{$stock->demand}}</td>--}}
                                            <td>{{$stock->unit}}</td>
{{--                                            <td>{{ number_format((($stock->demand*4) / 31), 2, '.', ',') }}</td>--}}
{{--                                            <td>{{ number_format(((($stock->demand*4) / 31)*2), 2, '.', ',') }}</td>--}}
{{--                                            <td>{{ number_format((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)), 2, '.', ',') }}</td>--}}
                                            <td>{{ ceil((((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2))) }}</td>
                                            <td>{{ ceil((((($stock->demand*4) / 31)*2) + ((((($stock->demand*4) / 31) * .1) + (($stock->demand*4) / 31)) * 4) - ((($stock->demand*4) / 31)*2))) }}</td>
                                            <td class="text-center"><a href="/stocks/{{$stock->id}}"><i class="fa fa-eye"></i></a></td>
                                            {{--<td>{{$stock->stocks}}</td>--}}
                                            {{--<td class="{{($stock->stocks <= $stock->procurement) ? "text-danger font-weight-bold" : ""}}">{{$stock->procurement}}</td>--}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <th colspan="12">No stocks found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {!! $stocks->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
                @if(count($stocks) > 0)
                    <div class="card-footer small text-muted">Last updated: {{date('D M d, Y h:i A', strtotime($stocks[0]->updated_at))}}</div>
                @endif
            </div>
        </div>

    </div>

@endsection