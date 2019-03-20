<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(odd) {background-color: #f2f2f2;}
    th {
        background-color: #020292;
        color: white;
        font-weight: bolder;
    }
</style>
<body>
<div style="float: right;">
    <h1>RECEIPT</h1>
</div>
<div style="">
    <h2>Alfren's Furniture</h2>
</div>

<div style="margin-top: 30px;">
    <h4>Client's Name: <b>{{$order->name}}</b></h4>
    <h4>Date Created: <b>{{date('D M d, Y', strtotime($order->created_at))}}</b></h4>
    <h4>Ready By: <b>{{date('D M d, Y', strtotime($order->ready_by))}}</b></h4>
    <h4>Total Cost: <b>{{$order->total}}</b></h4>
    <div class="card-body mt-2" style="overflow-x: auto;">
        <table class="table table-hover table-responsive-lg">
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price/Unit</th>
                <th>Subtotal</th>
            </tr>
            @foreach($order->singleOrders as $item)
                <tr>
                    <td>{{$item->product['name']}}</td>
                    <td>{{$item->product['description']}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->price * $item->quantity}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>