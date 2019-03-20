@extends('layouts.main')

@section('content')

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Safety Stocks</li>
  </ol>

  <div class="row">

    <div class="col-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Safety Stocks
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Stocks Remaining</th>
                  <th>Ordering Point</th>
                  <th>Show</th>
                </tr>
              </thead>
              <tbody>
                @if(count($stocks) > 0)
                    @foreach($stocks as $stock)
                        <tr>
                          <td>{{$stock->name}}</td>
                          <td>{{$stock->category}}</td>
                          <td>{{$stock->description}}</td>
                          <td>{{$stock->stocks}}</td>
                          <td>{{$stock->procurement}}</td>
                          <td><a href="/stocks/{{$stock->id}}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <th colspan="5">No need for restock.</th>
                    </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Last updated: {{date('D M d, Y h:i A', strtotime($stocks[0]->updated_at))}}</div>
      </div>
    </div>

  </div>

@endsection