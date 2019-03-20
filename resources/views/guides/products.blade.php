@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/products">Bill of Materials</a></li>
        <li class="breadcrumb-item active">Guide</li>
    </ol>

    <!-- Page Content -->
    <h2>Bill of Materials' Guide</h2>
    <hr>
    <div class="container-fluid">
        <div class="row">

            <div class=" col-md-5">
                <h3><i class="fa fa-feather"></i> View a product</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/products">Bill of Materials Page</a>.</li>
                        <li>Simply click the eye-icon (<i class="fa fa-eye"></i>) of the product in the table.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Add new product</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/products">Bill of Materials Page</a>.</li>
                        <li>Click the "Create" button.</li>
                        <li>
                        Fill all the fields needed, especially those who has red asterisk
                        (<span class="text-danger">*</span>).
                        </li>
                        <li>Click the "Add new field for materials needed" button to add raw materials needed.</li>
                        <li>Click the "Save" button.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Edit a product</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/products">Bill of Materials Page</a>.</li>
                        <li>Simply click the eye-icon (<i class="fa fa-eye"></i>) of the product in the table.</li>
                        <li>Click the "Edit" button.</li>
                        <li>
                            Fill all the fields needed, especially those who has red asterisk
                            (<span class="text-danger">*</span>).
                        </li>
                        <li>Click the "Add new field for materials needed" button to add raw materials needed.</li>
                        <li>Click the "Save" button.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

            </div>

            <div class="col-md-5 offset-md-1">

                <h3><i class="fa fa-feather"></i> Delete a product</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/products">Bill of Materials Page</a>.</li>
                        <li>Simply click the eye-icon (<i class="fa fa-eye"></i>) of the product in the table.</li>
                        <li>Click the "Delete" button.</li>
                        <li>Click "Delete" in the alertbox that will show up.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

            </div>

        </div>
    </div>

@endsection