@extends('layouts.main')

@section('content')

    <style>
        /* Bootstrap 4 text input with search icon */

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
    </style>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/orders">Orders</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <h3>Create Order</h3>
    <hr>
    @include('includes.messages')

    <div id="alert">
    </div>

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
                        <th>Price/unit <span class="text-danger">*</span></th>
                        <th>Subtotal</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="materialsBody">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group col-12 col-md-5 col-sm-8 mt-4">
            <label for="total">Total</label>: <b>₱ <span id="temp"></span><input id="total"  type="hidden" name="total"></b>
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
            convert(test('{{{$product->name}}}' + ' | ' + ' {{  $product->description}}' + ' | ' +' {{$product->capacity}} hours'))
        );
        ids.push('{{$product->id}}');
    @endforeach

    function convert (string) {
        return string.replace(/&#(?:x([\da-f]+)|(\d+));/ig, function (_, hex, dec) {
            return String.fromCharCode(dec || +('0x' + hex))
        })
    }

    function test(string) { return string.replace(/&quot;/g,'"'); }

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
            node_number.setAttribute("onkeyup","updateSubtotal(this)");
            td.appendChild(node_number);
            tr.appendChild(td);

            //PRICE
            td = document.createElement("td");
            td.className = 'form-group has-search';

            let subtotal = document.createElement("span");
            subtotal.className = 'fa fa-peso form-control-feedback';
            subtotal.innerText = '₱';

            let node_price = document.createElement("input");
            node_price.type = 'number';
            node_price.name = 'price[]';
            node_price.className = 'form-control';
            node_price.setAttribute("required", "required");
            node_price.setAttribute("step", "0.01");
            node_price.setAttribute("onkeyup","updateSubtotal(this)");
            node_price.setAttribute("placeholder", "Price per unit");

            td.appendChild(subtotal);
            td.appendChild(node_price);
            tr.appendChild(td);

            //SUBTOTAL
            td = document.createElement("td");
            let node_subtotal = document.createTextNode("₱ 0");
            td.appendChild(node_subtotal);
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
        else if (totalProducts === 0 && document.getElementById('alert').children.length === 0) {
            let div = document.createElement("div");
            div.className = 'alert alert-danger';
            div.innerText = 'Important! Insufficient raw materials.';
            document.getElementById('alert').appendChild(div);
        }
    }

    function updateSubtotal(r) {
        var temp = 0;
        var node = r.parentNode.parentNode.children;
        var quantity = node[1].children[0].value;
        var price = node[2].children[1].value;
        node[3].innerText = '₱ ' + (price * quantity).toLocaleString('en') ;
        setTotal();
    }

    function setTotal() {
        var temp = 0;
        var tBodyChildren = document.getElementById('materialsBody').children;
        for(var i = 0; i < tBodyChildren.length; i++) {
            if (tBodyChildren[i].children[1].children[0].value.length > 0 && tBodyChildren[i].children[2].children[1].value > 0)
                temp += (parseFloat(tBodyChildren[i].children[1].children[0].value) * parseFloat(tBodyChildren[i].children[2].children[1].value));
        }

        document.getElementById("total").value = temp;
        document.getElementById("temp").innerText = temp.toLocaleString('en');
    }

    function deleteRow(r) {
        let i = (r.parentNode.parentNode.rowIndex);
        document.getElementById("materialsTable").deleteRow(i);

        if (document.getElementById("materialsTable").getElementsByTagName('tr')[1] === undefined)
            document.getElementById('proceed').disabled = true;
    }

    // function checkStocks(r, evt, stocks){
    //     var charCode = (evt.which) ? evt.which : event.keyCode;
    //
    //     if (
    //         //0~9
    //         charCode >= 48 && charCode <= 57 ||
    //         //number pad 0~9
    //         charCode >= 96 && charCode <= 105 ||
    //         //backspace
    //         charCode == 8 ||
    //         //tab
    //         charCode == 9 ||
    //         //enter
    //         charCode == 13 ||
    //         //left, right, delete..
    //         charCode >= 35 && charCode <= 46
    //     ) {
    //         //make sure the new value below the STOCKS
    //         if(
    //             (parseInt(r.value+String.fromCharCode(charCode), 10) <= stocks) ||
    //             (parseInt(String.fromCharCode(charCode)+r.value, 10) <= stocks)
    //         ) return true;
    //     }
    //
    //     // evt.preventDefault();
    //     // evt.stopPropagation();
    //
    //     updateSubtotal(r, stocks);
    //
    //     return false;
    // }
</script>

@endsection