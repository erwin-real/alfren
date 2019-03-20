@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/stocks">Inventory</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <h3>Add New Raw Material</h3>
    <hr>

    <span class="text-danger">* required</span>

    {!! Form::open(['action' => 'StockController@store', 'method' => 'POST', 'class' => 'mt-4']) !!}
        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('name', 'Material\'s Name')}} <span class="text-danger">*</span>
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Name', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('category', 'Category')}} <span class="text-danger">*</span>
            {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Catergory', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('description', 'Description')}} <span class="text-danger">*</span>
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Description', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('unit', 'Unit')}} <span class="text-danger">*</span>
            {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Enter Material\'s Unit', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('stocks', 'Number of Stocks')}} <span class="text-danger">*</span>
            {{Form::number('stocks', '', ['class' => 'form-control', 'placeholder' => 'Enter Number of Stocks', 'required' => 'required'])}}
        </div>

        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{Form::label('demand', 'Demand')}} <span class="text-danger">*</span>
            {{Form::number('demand', '', ['class' => 'form-control', 'placeholder' => 'Enter Demand', 'required' => 'required'])}}
        </div>


        <div class="form-group col-12 col-lg-4 col-md-7 col-sm-8 mt-4">
            {{--{{Form::label('procurement', 'Ordering Point')}} <span class="text-danger">*</span>--}}
            {{--{{Form::number('procurement', '', ['class' => 'form-control', 'placeholder' => 'Enter Ordering Point', 'required' => 'required'])}}--}}

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-outline-success"><i class="fa fa-clipboard-check"></i> Submit</button>
            </div>
        </div>

    {!! Form::close() !!}

    <a href="/stocks" class="btn btn-outline-primary mt-4 mx-2"><i class="fas fa-chevron-left"></i> Back</a>

@endsection