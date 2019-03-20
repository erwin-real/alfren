@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/products">Bill of Materials</a>
        </li>
        <li class="breadcrumb-item active">
            Create
        </li>
    </ol>
    <h3>Create New Product</h3>
    <hr>

    <span class="text-danger">* required</span>

    {!! Form::open(['action' => 'ProductController@store', 'method' => 'POST', 'class' => 'mt-4']) !!}
        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="name">Product's Name</label>  <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="description">Description</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="description" required>
        </div>

        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="capacity">Capacity (hours)</label> <span class="text-danger">*</span>
            <input type="number" class="form-control" name="capacity" required>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="materialsTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Materials Needed <span class="text-danger">*</span></th>
                        <th>Number <span class="text-danger">*</span></th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="materialsBody">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group col-12">
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Save</button>
            </div>
        </div>
    {!! Form::close() !!}

    <button class="btn btn-outline-info" href="#" onclick="addRow()"><i class="fas fa-plus"></i> Add new field for materials needed</button><br/>

    <a href="/products" class="btn btn-outline-primary mt-4 mb-4 mx-2"><i class="fas fa-chevron-left"></i> Back</a>

<script type="text/javascript">
    var values = [];
    var ids = [];
    var totalStocks = {{count($stocks)}}
    @foreach($stocks as $stock)
            values.push('{{$stock->name}}' + ' | ' + ' {{$stock->category}} ' + ' | ' + '{{$stock->description}}');
            ids.push('{{$stock->id}}');
    @endforeach

    function addRow() {
        if (document.getElementsByClassName('select-class').length < totalStocks ) {
            let td, tr;
            let tbody = document.getElementById("materialsBody");

            // for each outer array row
            tr = document.createElement("tr");


            td = document.createElement("td");
            let selectList = document.createElement("select");
            selectList.setAttribute("class", "form-control select-class");
            selectList.name = 'stocks[]';

            for (let i = 0; i < values.length; i++) {
                let option = document.createElement("option");
                option.setAttribute("value", ids[i]);
                option.text = values[i];
                selectList.appendChild(option);
            }

            td.appendChild(selectList);
            tr.appendChild(td);


            td = document.createElement("td");
            let node_number = document.createElement("input");
            node_number.type = 'number';
            node_number.name = 'number[]';
            node_number.className = 'form-control';
            node_number.setAttribute("required", "required");
            td.appendChild(node_number);
            tr.appendChild(td);

            td = document.createElement("td");
            let node_del = document.createElement("i");
            node_del.className = 'fa fa-trash del-btn';
            node_del.style = "cursor:pointer";
            node_del.setAttribute("onclick", "deleteRow(this)");
            td.setAttribute("class", "text-center");
            td.appendChild(node_del);
            tr.appendChild(td);

            tbody.appendChild(tr);
        }
    }
    function deleteRow(r) {
        let i = (r.parentNode.parentNode.rowIndex);
        document.getElementById("materialsTable").deleteRow(i);
    }
</script>

@endsection