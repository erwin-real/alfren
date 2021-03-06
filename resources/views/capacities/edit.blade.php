@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/capacities">Daily Capacities</a></li>
        <li class="breadcrumb-item"><a href="/capacities/{{$capacity->id}}">{{date('D M d, Y', strtotime($capacity->capacity_date))}}</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <h3>Edit Capacity Date Details: {{date('D M d, Y', strtotime($capacity->capacity_date))}}</h3>
    <hr>

    <span class="text-danger">* required</span>

    {!! Form::open(['action' => ['CapacityController@update', $capacity->id], 'method' => 'POST', 'class' => 'mt-4']) !!}

        {{--<div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">--}}
            {{--{{Form::label('capDate', 'Date')}} <span class="text-danger">*</span>--}}
            {{--{{Form::date('capDate', date('Y-m-d', strtotime($capacity->capacity_date)), ['class' => 'form-control', 'placeholder' => 'Enter Capacity Date'])}}--}}
        {{--</div>--}}

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('total', 'Total Capacity (hours)')}} <span class="text-danger">*</span>
            {{Form::number('total', $capacity->total, ['class' => 'form-control', 'placeholder' => 'Enter Total Capacity', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            <div class="text-center mt-4">
                {{Form::hidden('_method', 'PUT')}}
                <button type="submit" class="btn btn-outline-success"><i class="fa fa-calendar-check"></i> Save</button>
{{--                {{Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-outline-success', '<i class="fa fa-eye"></i>'])}}--}}
            </div>
        </div>

    {!! Form::close() !!}

    <a href="/capacities" class="btn btn-outline-primary mt-4 mx-2"><i class="fas fa-chevron-left"></i> Back</a>

@endsection