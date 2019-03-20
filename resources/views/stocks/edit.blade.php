@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="/stocks">Inventory</a></li>
        <li class="breadcrumb-item active"><a href="/stocks/{{$stock->id}}">{{$stock->name}}</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ol>
    <h3>Edit Raw Material: {{$stock->name}}</h3>
    <hr>

    <span class="text-danger">* required</span>

    {!! Form::open(['action' => ['StockController@update', $stock->id], 'method' => 'POST', 'class' => 'mt-4']) !!}
        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('name', 'Material\'s Name')}} <span class="text-danger">*</span>
            {{Form::text('name', $stock->name, ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Name', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('category', 'Category')}} <span class="text-danger">*</span>
            {{Form::text('category', $stock->category, ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Catergory', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('description', 'Description')}} <span class="text-danger">*</span>
            {{Form::text('description', $stock->description, ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Description', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('stocks', 'Number of Stocks')}} <span class="text-danger">*</span>
            {{Form::text('stocks', $stock->stocks, ['class' => 'form-control', 'placeholder' => 'Enter Number of Stocks', 'required' => 'required'])}}
        </div>


        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{--{{Form::label('procurement', 'Ordering Point')}} <span class="text-danger">*</span>--}}
            {{--{{Form::text('procurement', $stock->procurement, ['class' => 'form-control', 'placeholder' => 'Enter Ordering Point', 'required' => 'required'])}}--}}

            <div class="text-center mt-4">
                {{Form::hidden('_method', 'PUT')}}
                <button type="submit" class="btn btn-outline-success"><i class="fa fa-clipboard-check"></i> Save</button>
            </div>
        </div>

    {!! Form::close() !!}

    <a href="/stocks" class="btn btn-outline-primary mt-4 mx-2"><i class="fas fa-chevron-left"></i> Back</a>

@endsection