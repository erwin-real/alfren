@extends('layouts.main')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <h3>Create Order</h3>
    <hr>
    @include('includes.messages')


    <span class="text-danger">* required</span>

    {!! Form::open(['action' => 'OrderController@proceed', 'method' => 'POST', 'class' => 'mt-4']) !!}
        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="client">Client's Name</label>  <span class="text-danger">*</span>
            <input type="text" class="form-control" name="client" required>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="materialsTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>
                            Products <span class="text-danger">*</span>
                            <br><small>Produce Name | Description | Capacity</small>
                        </th>
                        <th>Quantity <span class="text-danger">*</span></th>
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
                <button id="proceed" type="submit" class="btn btn-outline-success" disabled><i class="fa fa-check"></i> Proceed</button>
            </div>
        </div>
    {!! Form::close() !!}

    <button class="btn btn-outline-info" href="#" onclick="addRow()"><i class="fas fa-plus"></i> Add new field for products needed</button><br/>

    <a href="/orders" class="btn btn-outline-primary mt-4 mb-4 mx-2"><i class="fas fa-chevron-left"></i> Back</a>

<script type="text/javascript">
    var values = [];
    var ids = [];
    var totalProducts = {{count($products)}}
    @foreach($products as $product)
        values.push(
            '{{{$product->name}}}' + ' | ' + convert(test(' {{  $product->description}}')) + ' | ' + ' {{$product->capacity}} hours'
        );
        ids.push('{{$product->id}}');
    @endforeach

    function convert (string) {
        return string.replace(/&#(?:x([\da-f]+)|(\d+));/ig, function (_, hex, dec) {
            return String.fromCharCode(dec || +('0x' + hex))
        })
    }

    function test(string) {
        return string.replace(/&quot;/g,'"');

    }

    function addRow() {
        if (document.getElementsByClassName('select-class').length < totalProducts ) {
            let td, tr;
            let tbody = document.getElementById("materialsBody");

            // for each outer array row
            tr = document.createElement("tr");

            //SELECT TAG
            td = document.createElement("td");
            let selectList = document.createElement("select");
            selectList.setAttribute("class", "form-control select-class");
            selectList.name = 'products[]';

            for (let i = 0; i < values.length; i++) {
                let option = document.createElement("option");
                option.setAttribute("value", ids[i]);
                option.text = values[i];
                selectList.appendChild(option);
            }

            td.appendChild(selectList);
            tr.appendChild(td);


            //QUANTITY
            td = document.createElement("td");
            let node_number = document.createElement("input");
            node_number.type = 'number';
            node_number.name = 'quantity[]';
            node_number.className = 'form-control';
            node_number.setAttribute("required", "required");
            td.appendChild(node_number);
            tr.appendChild(td);


            //DELETE BTN
            td = document.createElement("td");
            let node_del = document.createElement("i");
            node_del.className = 'fa fa-trash del-btn';
            node_del.style = "cursor:pointer";
            node_del.setAttribute("onclick", "deleteRow(this)");
            td.setAttribute("class", "text-center");
            td.appendChild(node_del);
            tr.appendChild(td);

            tbody.appendChild(tr);
            document.getElementById('proceed').disabled = false;
        }

    }
    function deleteRow(r) {
        let i = (r.parentNode.parentNode.rowIndex);
        document.getElementById("materialsTable").deleteRow(i);

        if (document.getElementById("materialsTable").getElementsByTagName('tr')[1] == undefined)
            document.getElementById('proceed').disabled = true;
    }
</script>

@endsection