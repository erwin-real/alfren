@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/capacities">Daily Capacities</a></li>
        <li class="breadcrumb-item active">Guide</li>
    </ol>

    <!-- Page Content -->
    <h2>Daily Capacities' Guide</h2>
    <hr>
    <div class="container-fluid">
        <div class="row">

            <div class=" col-md-5">
                <h3><i class="fa fa-feather"></i> View a daily capacity</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/capacities">Daily Capacities Page</a>.</li>
                        <li>Simply click the eye-icon (<i class="fa fa-eye"></i>) of the daily capacity in the table.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Add new daily capacity</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/capacities">Daily Capacities Page</a>.</li>
                        <li>Click the "Add" button.</li>
                        <li>
                        Fill all the fields needed, especially those who has red asterisk
                        (<span class="text-danger">*</span>).
                        </li>
                        <li>Click the "Save" button.</li>
                        <li>Finish!</li>
                        <span style="margin-left: -10px;">*Note: The daily capacity won't submit if the selected date is already in the past, is Sunday, or assigned already.</span>
                    </ol>
                </div>

                <h3><i class="fa fa-feather"></i> Edit a daily capacity</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/capacities">Daily Capacities Page</a>.</li>
                        <li>Simply click the eye-icon (<i class="fa fa-eye"></i>) of the daily capacity in the table.</li>
                        <li>Click the "Edit" button.</li>
                        <li>Edit the "Total Capacity" field.</li>
                        <li>Click the "Save" button.</li>
                        <li>Finish!</li>
                    </ol>
                </div>

            </div>

            <div class="col-md-5 offset-md-1">

                <h3><i class="fa fa-feather"></i> Delete a daily capacity</h3>
                <div class="mx-2">
                    <ol>
                        <li>Go to <a href="/capacities">Daily Capacities Page</a>.</li>
                        <li>Simply click the eye-icon (<i class="fa fa-eye"></i>) of the daily capacity in the table.</li>
                        <li>Click the "Delete" button.</li>
                        <li>Click "Delete" in the alertbox that will show up.</li>
                        <li>Finish!</li>
                        <span style="margin-left: -10px;">*Note: Daily capacity can only be deleted when the date is past already.</span>
                    </ol>
                </div>

            </div>

        </div>
    </div>

@endsection