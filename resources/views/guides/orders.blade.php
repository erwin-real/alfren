@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
        <li class="breadcrumb-item active">Guide</li>
    </ol>

    <!-- Page Content -->
    <h2>Order's Guide</h2>
    <hr>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <h3><i class="fa fa-feather"></i> View an order</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/orders">Orders Page</a>.</li>
                        <li>Simply click the "Show" button of the order.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Create new order</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/orders">Orders Page</a>.</li>
                        <li>Click the "New" button.</li>
                        <li>
                        Fill all the fields needed, especially those who has red asterisk
                        (<span class="text-danger">*</span>).
                        </li>
                        <li>Click the "Add new field for products needed" button to add products needed.</li>
                        <li>Click the "Proceed" button.</li>
                        <li>Verify orders.</li>
                        <li>Then, click the "Submit" button.</li>
                        <li>Finish!</li>
                        <span style="margin-left: -10px;">*Note: The order won't submit if company is lacking daily capacities or the order has duplicate products</span>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Delete an order</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/orders">Orders Page</a>.</li>
                        <li>Click the "Show" button of the order.</li>
                        <li>Click the "Delete" button.</li>
                        <li>Click "Delete" in the alertbox that will show up.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Print an order</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/orders">Orders Page</a>.</li>
                        <li>Click the "Show" button of the order.</li>
                        <li>Click the "Export" button.</li>
                        <li>Then print as PDF.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

            </div>

        </div>
    </div>

@endsection